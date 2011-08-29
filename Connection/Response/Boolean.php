<?php
class Connection_Response_Boolean extends Connection_Response
{

    public function __construct($value) 
    {
        $this->_data = $value;
    }

    public function isSuccess() 
    {
        return $this->_data == 1;
    }

}
