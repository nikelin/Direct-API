<?php
class API_Request_DeleteWordstatReport extends Connection_Request_Abstract
{

    public static $method = "DeleteWordstatReport";

    public function __construct($reportId) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setScalarParameter($reportId);
    }

    public function isValid() 
    {
        return true;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Boolean($data['data']);
    }

}