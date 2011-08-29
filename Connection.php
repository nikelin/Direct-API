<?php
/**
 * Default connection implementation based on PHP standard sockets
 * implementation.
 * 
 * @see Connection_Request_Headers
 * @see Connection_Protocol_Interface
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Connection implements Connection_Interface
{

    public static $defaultGateway = "soap.direct.yandex.ru";
    public static $defaultPath = "/json-api/v4";
    
    private $_socket;

    /**
     * Gateway information
     */
    private $_gateway;
    private $_host;
    private $_path;
    private $_port;

    /**
     * Connection authentication credentials     
     */
    private $_authToken;
    private $_applicationId;
    private $_login;

    /**
     * Gateway interaction protocol
     * responsible for request/response rendering/hydrating
     * on current connection.
     *            
     * @var Connection_Protocol_Interface  
     */
    private $_protocol;

    public function __construct(Connection_Protocol_Interface $protocol, 
            $login, $authToken, $applicationId, $port = 443, $gateway = NULL, 
            $path = NULL) 
    {
        if ($protocol == null) {
            throw new Connection_Exception("Protocol must not be null");
        }

        $this->state = Connection_State::$none;
        $this->_protocol = $protocol;
        $this->_login = $login;
        $this->_applicationId = $applicationId;
        $this->_port = $port;
        $this->_authToken = $authToken;

        $this->_gateway = Utils::ifsetor($gateway, self::$defaultGateway);
        $this->_path = Utils::ifsetor($path, self::$defaultPath);
    }

    public function getState() 
    {
        return $this->state;
    }

    public function getConnectionInfo() 
    {
        return sprintf(
            "Connection with status %s and credentials %s:%s@%s", 
            $this->getState(), $this->_login, $this->_authToken, 
            $this->_gateway
        );
    }

    public function connect() 
    {
        if ($this->state === Connection_State::$established) {
            throw new Connection_Exception(
                "Stop active connection before another connect"
            );
        }

        $this->_socket = fsockopen(
            ( $this->_port == 80 ? "http://" : "ssl://" ) . $this->_gateway,
            $this->_port, $errno, $errstr, 30
        );
        if (!$this->_socket) {
            throw new Connection_Exception(
                sprintf(
                    "Unable to establish connection %s: %s:%s", 
                    $this->_gateway, $errstr, $errno
                )
            );
        }

        $this->state = Connection_State::$established;
    }

    public function disconnect() 
    {
        if ($this->state !== Connection_State::$established) {
            throw new Connection_Exception(
                "Connection needs to be".
                "established first"
            );
        }

        fclose($this->_socket);

        $this->state = Connection_State::$none;
        $this->_socket = null;
    }

    protected function getProtocol() 
    {
        return $this->_protocol;
    }

    protected function prepareDefaultHeaders(
            $contentLength, 
            $mimeType = "application/json", $encoding = "utf8") 
    {
        return "POST {$this->_path} HTTP/1.1\n"
                . "Host: {$this->_gateway}\n"
                . "Content-Length: {$contentLength}\n"
                . "Content-Type: {$mimeType}; charset={$encoding}"
                . "\n\n";
    }

    /**
     * Prepare request object to send throught HTTP connection
     * 
     * @return string        
     */
    protected function prepareRequest(Connection_Request_Interface $request) 
    {
        $result = $this->getProtocol()->renderRequest($request);
        $result = $this->prepareDefaultHeaders(strlen($result)) . $result;
        return $result;
    }

    public function invoke(Connection_Request_Interface $request) 
    {
        if ( $this->state != Connection_State::$established ) {
            $this->connect();
        }

        if (!$request->isValid()) {
            throw new Entities_Validator_Exception(
                sprintf("Request %s validation failed!", get_class($request))
            );
        }

        if ($request->isAuthRequired()) {
            $request->setHeader(
                Connection_Request_Headers::$login, 
                $this->_login
            );
            $request->setHeader(
                Connection_Request_Headers::$authToken, 
                $this->_authToken
            );
            $request->setHeader(
                Connection_Request_Headers::$applicationId, 
                $this->_applicationId
            );
        }

        $data = $this->prepareRequest($request);
        Utils::log(sprintf("Sending data on gateway: %s", $data));
        $status = fwrite($this->_socket, $data . "\n");
        if (!$status) {
            throw new Connection_Exception(
                sprintf(
                    "Method %s invocation failed!", 
                    $request->getMethod()
                )
            );
        }

        $responseBody = fread($this->_socket, 4096);
        Utils::log(sprintf("Received response body: \n %s", $responseBody));

        $this->disconnect();

        return $this->getProtocol()
                        ->hydrateResponse($request, $responseBody);
    }

}
