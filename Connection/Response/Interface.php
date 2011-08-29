<?php
interface Connection_Response_Interface
{

    /**
     * Return true is this object represents
     * API error object
     *    
     */
    public function isError();

    public function isSuccess();
    
}
