<?php
class API_Request_CreateNewWordstatReport extends Connection_Request_Abstract
{

    public static $method = "CreateNewWordstatReport";

    public function __construct(array $phrases = array(), 
                                array $geoIds = array()) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setParameters(array("Phrases" => $phrases, "GeoID" => $geoIds));
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
