<?php
/**
 * Base interface for all low-level API gateway connectors
 * implementation.
 * 
 * @see Connection
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
interface Connection_Interface
{

    public function getState();

    public function connect();

    public function disconnect();

    public function getConnectionInfo();

    /**
     * @return Connection_Response_Interface  
     */
    public function invoke(Connection_Request_Interface $request);
}