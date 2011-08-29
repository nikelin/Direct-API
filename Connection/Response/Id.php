<?php
class Connection_Response_Id extends Connection_Response
{

    public function __construct($data) 
    {
        if (!is_numeric($data)) {
            throw new Exception("Illegal argument exception!");
        }

        $this->_data = $data;
    }

    public function getObjectId() 
    {
        return $this->_data;
    }

}