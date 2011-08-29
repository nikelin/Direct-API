<?php
class Connection_Response_Array extends Connection_Response 
                                implements Countable, Iterator
{

    private $_childs = array();

    public function __construct(array $data = array()) 
    {
        $this->initChilds($data);
    }

    protected function initChilds(array $data = array()) 
    {
        foreach ($data as $key => $item) {
            $this->_childs[] = new Connection_Response($item);
        }
    }

    protected function isNestedStructure($item) 
    {
        return is_array($item) && count($item) > 0
                && is_array(array_shift($item));
    }

    public function count() 
    {
        return count($this->_childs);
    }

    public function rewind() 
    {
        return reset($this->_childs);
    }

    public function current() 
    {
        return current($this->_childs);
    }

    public function valid() 
    {
        $key = key($this->_childs);
        return ($key !== NULL && $key !== FALSE);
    }

    public function key() 
    {
        return key($this->_childs);
    }

    public function next() 
    {
        return next($this->_childs);
    }

    public function get($idx) 
    {
        return $this->_childs[$idx];
    }

}
