<?php
class API_Request_GetCampaignsList extends Connection_Request_Abstract
{

    public static $method = "GetCampaignsList";

    public function __construct($ids = array()) 
    {
        parent::__construct(self::$method);

        $this->setParameters(Utils::ifsetor($ids, array()));
        $this->setAuthRequired(true);
    }

    public function isValid() 
    {
        return true;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response($data['data']);
    }

}
