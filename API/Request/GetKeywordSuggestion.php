<?php
class API_Request_GetKeywordsSuggestion extends Connection_Request_Abstract
{

    public static $method = "GetKeywordsSuggestion";

    public function __construct($keywords = array()) 
    {
        parent::__construct(self::$method);

        $this->setAuthRequired(true);
        $this->setParameters(
            array(
                "Keywords"=>$keywords
            )
        );
    }

    public function isValid() 
    {
        return count($this->getParameter("Keywords")) > 0;
    }

    public function createResponse(array $data = array()) 
    {
        return new Connection_Response($data['data']);
    }

}