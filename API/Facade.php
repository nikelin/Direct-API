<?php
/**
 * Facade class to provides API methods invoke shortcuts
 * 
 * @see Connection_Interface
 * @see Connection_Protocol_Interface
 * @see Connection_Request_Interface
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
final class API_Facade
{
    private static $_connection;

    public static function setConnection(Connection_Interface $connection) 
    {
        if ($connection == null) {
            throw new Exception("<null>");
        }

        self::$_connection = $connection;
    }

    private static function checkAssertions() 
    {
        if (self::$_connection == null) {
            throw new Exception("No connection provided!");
        }
    }

    public static function createNewForecastReport(
                                    array $phrases = array(), 
                                    array $categories = array(), 
                                    array $geoIds = array()) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_CreateNewForecast(
                $phrases, $categories, $geoIds
            )
        );
    }

    public static function deleteForecastReport($id) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_DeleteForecastReport($id)
        );
    }

    public static function getForecastReportsList() 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetForecastList()
        );
    }

    public static function getForecastReport($reportId) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetForecast($reportId)
        );
    }

    public static function createNewWordstatReport(
                            array $phrases = array(), array $geoId = array()) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_CreateNewWordstatReport($phrases, $geoId)
        );
    }

    public static function getWordstatReport($reportId) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetWordstatReport($reportId)
        );
    }

    public static function getWordstatReportsList() 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetWordstatReportList()
        );
    }

    public static function deleteWordstatReport($reportId) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_DeleteWordstatReport($reportId)
        );
    }

    public static function getCampaignBalance($campaignId) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetCampaignBalance($campaignId)
        );
    }

    public static function getTimeZones() 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetTimeZones()
        );
    }

    public static function getAvailableVersions() 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetAvailableVersions()
        );
    }

    public static function getBanners(array $campaignIds = array(), 
                                      array $bannerIds = array(), 
                                      $getPhrases = NULL, 
                                      array $filter = array()) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetBanners(
                $campaignIds, $bannerIds, $getPhrases, $filter
            )
        );
    }

    public static function getBannerPhrases(array $ids = array()) 
    {
        self::checkAssertions();
        return self::$_connection->invoke(
            new API_Request_GetBannerPhrases($ids)
        );
    }

}