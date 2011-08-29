<?php
/**
 * @see Data_Campaign
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
abstract class Entities_Abstract implements Entities_Interface
{
    private $_fields = array();

    protected function addField(Entities_Field_Interface $field) 
    {
        $this->_fields[$field->getName()] = $field;
    }

    protected function removeField(Entities_Field_Interface $field) 
    {
        unset($this->_fields[$field->getName()]);
    }

    public function getFields() 
    {
        return $this->_fields;
    }

    public function __call($name, $value) 
    {
        if (StringUtils::startsWith($name, "set")) {
            $this->executeSetter($name, $value);
        } else if (StringUtils::startsWith($name, "get")) {
            $this->executeGetter($name);
        }
    }

    public function __set($name, $value) 
    {
        if (!isset($this->_fields[$name])) {
            throw new Exception("Field {$name} not found!");
        }

        $this->_fields[$name]->setValue($value);
    }

    public function __get($name) 
    {
        if (!isset($this->_fields[$name])) {
            throw new Exception("Field {$name} not found!");
        }

        return $this->_fields[$name]->getValue();
    }

    private function checkFieldExists($fieldName) 
    {
        $found = false;
        foreach ($this->getFields() as $key => $value) {
            if ($fieldName === $key) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    private function executeGetter($name) 
    {
        $name = substr($name, 3);
        if (!$this->checkFieldExists($name)) {
            throw new Exception(sprintf("Field %s not found!", $name));
        }

        return $this->_fields[$name]->getValue();
    }

    private function executeSetter($name, array $args = array()) 
    {
        $name = substr($name, 3);
        if (empty($args)) {
            throw new Exception(
                sprintf(
                    "Non-empty arguments list expected for method %s", 
                    $methodName
                )
            );
        }

        if (!$this->checkFieldExists($name)) {
            throw new Exception(sprintf("Field %s not found!", $name));
        }

        $this->_fields[$name]->setValue($args[0]);
    }

}
