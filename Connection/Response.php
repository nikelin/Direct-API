<?php
class Connection_Response implements Connection_Response_Interface
{

    private $_data;

    public function __construct(array $data) 
    {
        $this->initData($data);
    }

    protected function initData(array $data) 
    {
        foreach ($data as $key => $value) {
            if (is_scalar($value)) {
                $this->_data[$key] = $value;
            } else if (is_array($value)) {
                if (count($value) == 1) {
                    $value = $value[0];
                }

                if (is_numeric(array_shift(array_keys($value)))) {
                    $this->_data[$key] = new Connection_Response_Array($value);
                } else {
                    $this->_data[$key] = new Connection_Response($value);
                }
            }
        }
    }

    public function isSuccess() 
    {
        return true;
    }

    public function isError() 
    {
        return false;
    }

    public function __call($name, array $args) 
    {
        if (StringUtils::startsWith($name, "get") && strlen($name) != 3) {
            $name = ucfirst(substr($name, 3));
            if (isset($this->_data[$name])) {
                return $this->_data[$name];
            }

            return null;
        }

        throw new Exception("Unknown method $name!");
    }

}