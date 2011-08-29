<?php
/**
 * Abstract request implementation to use in concrete implemetations
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
abstract class Connection_Request_Abstract 
                    implements Connection_Request_Interface
{

    /**
     * @var string
     */
    private $_method;

    /**
     * @var bool
     */
    private $_authRequired;

    /**
     * @var bool
     */
    private $_isScalar;
    private $_parameters = array();
    private $_headers = array();

    public function __construct($method) 
    {
        $this->_method = $method;
    }

    public function setAuthRequired($value) 
    {
        $this->_authRequired = $value;
    }

    public function isAuthRequired() 
    {
        return $this->_authRequired;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function setScalarParameter($value) 
    {
        $this->_parameters[0] = $value;
        $this->_isScalar = true;
    }

    public function isScalarParameter() 
    {
        return $this->_isScalar;
    }

    public function getScalarParameter() 
    {
        if (!$this->isScalarParameter()) {
            return null;
        }

        return $this->_parameters[0];
    }

    public function setParameters(array $parameters) 
    {
        if ($this->isScalarParameter()) {
            throw new Exception(
                "Unable to set parameters list on scalar" .
                " queries"
            );
        }

        $this->_parameters = $parameters;
    }

    public function getParameters() 
    {
        if ($this->isScalarParameter()) {
            throw new Exception(
                "Unable to request parameters list on scalar" .
                " queries"
            );
        }

        return $this->_parameters;
    }

    public function getParameter($name) 
    {
        if ($this->isScalarParameter()) {
            throw new Exception(
                "Unable to request parameters list on scalar" .
                " queries"
            );
        }

        return $this->_parameters[$name];
    }

    public function setParameter($name, $value) 
    {
        if ($this->isScalarParameter()) {
            throw new Exception(
                "Unable to set parameters on scalar" .
                " queries"
            );
        }

        $this->_parameters[$name] = $value;
    }

    public function setHeaders(array $headers) 
    {
        $this->_headers = $headers;
    }

    public function getHeaders() 
    {
        return $this->_headers;
    }

    public function getHeader($name) 
    {
        return $this->_headers[$name];
    }

    public function setHeader($name, $value) 
    {
        $this->_headers[$name] = $value;
    }

}
