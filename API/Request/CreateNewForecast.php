<?php
class API_Request_CreateNewForecast extends Connection_Request_Abstract
{

    public static $method = "CreateNewForecast";

    public function __construct(array $phrases = array(), 
                                array $categories = array(), 
                                array $geoIds = array()) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setParameters(
            array(
                "Phrases" => $phrases,
                "GeoID" => $geoIds,
                "Categories" => $categories
            )
        );
    }

    public function isValid() 
    {
        return count($this->getParameter("Phrases")) > 0;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Id($data['data']);
    }

}