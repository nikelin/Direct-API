<?php
/**
 *  Complete implementation of Yandex.Direct API
 *  
 *  @author  Cyril A. Karpenko <self@nikelin.ru>
 *  @company  Redshape Ltd. <company@redshape.ru>     
 */
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define("DEBUG", true);
define("RENDERER_SKIP_NULLED", true);

/**
 * Needs to be changed when Zend or other classloading feature
 * provider will be integrated
 * 
 * @param type $class_name 
 */
function __autoload($className) 
{
    $path = __DIR__ . "/" . str_replace("_", "/", $className) . '.php';
    require_once realpath($path);
}



/* * ********
 * Usecases
 * ******* */
try {
    /**
     * Connection setup with providing reference to
     * API_Facade
     * @see API_Facade
     */
    API_Facade::setConnection(
        $connection = new Connection(
            new Connection_Protocol_JSON(), 
            "kirill-karpenko1",
            "d0150ec6b66a43d58a3d72f244146d14",
            "c6d146e00ad84728b56faf088bd1e9e9"
        )
    );
    /**
     * Connection establishing with Yandex.Direct API
     */
    $connection->connect();
    
    /**
     * Print currently available versions of API and theirs border date 
     * (deprecation date)
     */
    echo "Available API versions:\n";
    $versions = API_Facade::getAvailableVersions();
    foreach ($versions as $version) {
        echo sprintf(
            "Version #%d which border date is %s\n", 
            $version->getVersionNumber(), 
            Utils::ifsetor(
                $version->getBorderDate(), 
                "<Not defined>"
            ) 
        );
    }
    
    /**
     * Request wordstat reports buffer (rerpots which were generated in part,
     * but not deleted currently)
     */
    $response = API_Facade::getWordstatReportsList();
    if (count($response) == null) {
        /**
         * Create new wordstat report for a phrases "Nikelin" and "Jellical"
         */
        API_Facade::createNewWordstatReport(array("Nikelin", "Jellical"));
        /**
         * Analogical for phrase "Redshape"
         */
        API_Facade::createNewWordstatReport(array("Redshape"));
    }
    
    /**
     * If as response received error description object
     * then exception will be generated
     * 
     * @IMPORTANT@
     * Needs to say, that all responses values can be accessed by the name
     * equals to a Yandex.Direct documentation.
     * 
     * So, if response received has structure like this:
     * {
     *    data : [
     *    { 
     *          Phrases : [
     *              { Frequence : 255 }
     *          ]
     *    }
     * }
     * 
     * The value `Frequence` can accessed in the next manner:
     * $request->get(0)->getPhrases()->get(0)
     *                               ->getFrequence() -> will return `255`
     * 
     */
    if ( $response->isError() ) {
        /**
         * Convert Connection_Response_Interface object to
         * Connection_Response_Exception object with delegation
         * all information about error ( code and short description message )
         */
        $reponse->asException();
    }
    /**
     * Iterates reports ID's and request concerete reports
     * with interested details
     */
    foreach ($response as $result) {
        /**
         * Request concerete report by it's ID
         */
        $reportResponse = API_Facade::getWordstatReport($result->getReportID());
        if ($reportResponse->isError()) {
            $reportResponse->asException();
        }
        /**
         * Iterate received report prts
         */
        foreach ($reportResponse as $reportPart) {
            echo sprintf(
                "\nPhrase `%s` has %d shows \n", 
                $reportPart->getSearchedWith()->getPhrase(), 
                $reportPart->getSearchedWith()->getShows()
            );
        }
        /**
         * Delete wordstat report but it's ID
         */
        $deleteResponse = API_Facade::deleteWordstatReport(
            $result->getReportID()
        );
        if ($deleteResponse->isError()) {
            $deleteResponse->asException();
        } else {
            echo sprintf(
                "\nReport #%d successfuly deleted!\n", 
                $response->getReportID()
            );
        }
    }
    
    /**
     * Request generated forecasts IDs heap 
     */
    $forecastListResponse = API_Facade::getForecastReportsList();
    if (count($forecastListResponse) == 0) {
        /**
         * Create new forecast report request
         * @see API_Request_GetForecast
         */
        API_Facade::createNewForecastReport(array("Nikelin", "Redshape"));
        API_Facade::createNewForecastReport(array("Yandex", "Redshape23"));
        API_Facade::createNewForecastReport(array("Google Chrome", "Redshape"));
        sleep(5);
    }
    $forecastListResponse = null;
    do {
        $forecastListResponse = API_Facade::getForecastReportsList();
    } while (count($forecastListResponse) == 0);
    foreach ($forecastListResponse as $forecastReport) {
        $i = 0;
        $forecastResultResponse = null;
        do {
            $forecastResultResponse = API_Facade::getForecastReport(
                $forecastReport->getForecastID()
            );
        } while ($forecastResultResponse->isError() && $i++ < 10);
        foreach ($forecastResultResponse->getPhrases() as $phraseForecast) {
            echo sprintf(
                "\nReport #%d\n" .
                "\n----------\n" .
                "\nLowCTR Warning: %s\n" .
                "\nCTR: %s\n" .
                "\nMax: %s\n" .
                "\nMin: %s\n" .
                "\nPremium min(): %s\n" .
                "\nPremium max(): %s\n", 
                $forecastReport->getForecastID(), 
                $phraseForecast->getLowCTRWarning(), 
                $phraseForecast->getCTR(), 
                $phraseForecast->getMax(), 
                $phraseForecast->getMin(), 
                $phraseForecast->getPremiumMin(), 
                $phraseForecast->getPremiumMax()
            );
        }
    }
    echo var_dump(API_Facade::getBanners(array(1)));
    echo var_dump(API_Facade::getBannerPhrases(array(1)));
} catch (Exception $e) {
    echo sprintf(
        "\nError on line %d <'%s'> with code %s!\n", 
        $e->getLine(), 
        $e->getMessage(), 
        Utils::ifsetor($e->getCode(), "<null>")
    );
}
