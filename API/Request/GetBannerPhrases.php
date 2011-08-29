<?php
class API_Request_GetBannerPhrases extends Connection_Request_Abstract
{

    public static $method = "GetBannerPhrases";

    public function __construct(array $ids = array()) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setParameters($ids);
    }

    public function isValid() 
    {
        $count = count($this->getParameters());
        return $count > 0 && $count < 1000;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response_Array($data['data']);
    }

}