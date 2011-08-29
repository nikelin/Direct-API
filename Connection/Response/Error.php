<?php
class Connection_Response_Error implements Connection_Response_ErrorInterface
{

    private $_details;
    private $_message;
    private $_code;

    public function __construct($data) 
    {
        if ($data == null) {
            throw new Exception("<null>");
        }

        $this->_details = $data['error_detail'];
        $this->_message = $data['error_str'];
        $this->_code = $data['error_code'];
    }

    public function isError() 
    {
        return true;
    }

    public function isSuccess() 
    {
        return false;
    }

    public function getDetails() 
    {
        return $this->_details;
    }

    public function getCode() 
    {
        return $this->_code;
    }

    public function getMessage() 
    {
        return $this->_message;
    }

    public function asException() 
    {
        throw new Connection_Response_Exception($this->_message, $this->_code);
    }

}