<?php
interface Connection_Response_ErrorInterface 
                extends Connection_Response_Interface
{

    /**
     * Return short error description
     * @return string
     */
    public function getMessage();

    /**
     * Return detailed error description
     * @return string   
     */
    public function getDetails();

    /**
     * Return error numerical representation
     * @return int      
     */
    public function getCode();

    /**
     * Throws exception which code and message equals
     * API error code and message
     * @return Connection_Response_Exception
     */
    public function asException();
    
}

