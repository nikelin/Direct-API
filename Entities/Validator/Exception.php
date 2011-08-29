<?php
/**
 * Throws if validation failed on Connection_Interface::invoke(...)
 * 
 * @see Connection_Interface
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Validator_Exception extends Exception
{

    public function __construct($message, $code = NULL) 
    {
        $this->message = $message;
        $this->code = $code;
    }

}