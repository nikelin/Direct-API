<?php
/**
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Exception extends Exception
{

    public function __construct($message, $code = NULL) 
    {
        $this->message = $message;
        $this->code = $code;
    }

}
