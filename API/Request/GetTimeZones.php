<?php
class API_Request_GetTimeZones extends Connection_Request_Abstract
{

    public static $method = "GetTimeZones";

    public function __construct() 
    {
        parent::__construct(self::$method);
    }

    public function isValid() 
    {
        return true;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response($data);
    }

}
