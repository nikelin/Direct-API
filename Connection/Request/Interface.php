<?php
/**
 * Interface of request which can be sent throught
 * Connection_Interface::invoke(...) to Yandex.Direct API
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
interface Connection_Request_Interface
{

    public function createResponse(array $data = array());

    public function isScalarParameter();

    public function setScalarParameter($value);

    public function isAuthRequired();

    public function isValid();

    public function getMethod();

    public function getParameters();

    public function getParameter($name);

    public function getHeaders();

    public function getHeader($name);
}