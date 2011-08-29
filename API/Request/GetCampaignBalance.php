<?php
class API_Request_GetCampaignBalance extends Connection_Request_Abstract
{

    public static $method = "GetBalance";

    public function __construct($campaignId) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setScalarParameter($campaignId);
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