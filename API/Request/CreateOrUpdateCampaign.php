<?php
class API_Request_CreateOrUpdateCampaign extends Connection_Request_Abstract
{

    public static $method = "CreateOrUpdateCampaign";
    private $_campaign;

    public function __construct(Data_Campaign $campaign) 
    {
        parent::__construct(self::$method);

        $this->_campaign = $campaign;
        $this->setParameters($campaign->getFields());
        $this->setAuthRequired(true);
    }

    public function isValid() 
    {
        return $this->_campaign->isValid();
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Boolean($data['data']);
    }

}