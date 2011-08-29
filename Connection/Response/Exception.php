<?php
class Connection_Response_Exception extends Exception
{

    public function __construct($message, $code = NULL) 
    {
        $this->message = $message;
        $this->code = $code;
    }

}

