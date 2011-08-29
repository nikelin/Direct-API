<?php
class API_Request_GetForecast extends Connection_Request_Abstract
{

    public static $method = "GetForecast";

    public function __construct($reportId) 
    {
        parent::__construct(self::$method);

        $this->setScalarParameter($reportId);
        $this->setAuthRequired(true);
    }

    public function isValid()
    {
        return $this->getScalarParameter() != null;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response($data['data']);
    }

}