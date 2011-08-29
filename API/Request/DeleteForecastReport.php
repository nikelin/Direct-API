<?php
class API_Request_DeleteForecastReport extends Connection_Request_Abstract
{

    public static $method = "DeleteForecastReport";

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
        return new Connection_Response_Boolean($data['data']);
    }

}