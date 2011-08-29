<?php
class API_Request_GetBanners extends Connection_Request_Abstract
{

    public static $method = "GetBanners";

    public function __construct(array $campaignIds = array(), 
                                array $bannerIds = array(), 
                                $getPhrases = NULL, array $filter = array()) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);

        $parameters = array();

        if (!empty($campaignIds)) {
            $parameters["CampaignIDS"] = $campaignIds;
        }

        if (!empty($bannerIds)) {
            $parameters["BannerIDS"] = $bannerIds;
        }

        if (!empty($filter)) {
            $parameters["Filter"] = $filter;
        }

        $parameters["GetPhrases"] = Utils::ifsetor($getPhrases, "Yes");

        $this->setParameters($parameters);
    }

    public function isValid() 
    {
        return ( count($this->getParameter("CampaignIDS")) != 0
                || count($this->getParameter("BannerIDS")) != 0
                );
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Array($data['data']);
    }

}
