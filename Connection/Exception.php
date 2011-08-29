<?php
class Connection_Exception extends Exception
{

    public function __construct($message, $code = NULL) 
    {
        $this->message = $message;
        $this->code = $code;
    }

}