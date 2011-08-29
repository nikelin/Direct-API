<?php
class API_Request_GetWordstatReport extends Connection_Request_Abstract
{

    public static $method = "GetWordstatReport";

    public function __construct($reportId) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setScalarParameter($reportId);
    }

    public function isValid() 
    {
        return $this->getScalarParameter() != null
                && is_numeric($this->getScalarParameter());
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Array($data['data']);
    }

}
