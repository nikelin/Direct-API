<?php
class API_Request_GetWordstatReportList extends Connection_Request_Abstract
{

    public static $method = "GetWordstatReportList";

    public function __construct() 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
    }

    public function isValid() 
    {
        return true;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Array($data['data']);
    }

}
