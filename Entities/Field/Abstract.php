<?php
/**
 * @see Entity_Field_Interface
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
abstract class Entities_Field_Abstract implements Entities_Field_Interface, 
                                                  Countable
{

    private $_name;
    private $_required;
    private $_value;
    private $_validators = array();

    public function __construct($name, $required = false, $value = NULL, 
                                $validators = array()) 
    {
        $this->_name = $name;
        $this->_required = $required;
        $this->_value = $value;

        if ($this->_required) {
            $this->addValidator(new Entities_Validator_NotNull());
        }

        foreach ($validators as $validator) {
            $this->addValidator($validator);
        }
    }

    public function count() 
    {
        return count($this->fields);
    }

    public function addValidator(Entities_Validator_Interface $validator) 
    {
        if (in_array($validator, $this->_validators)) {
            return;
        }

        $this->_validators[] = $validator;
    }

    public function isRequired() 
    {
        return $this->_required;
    }

    public function isValid() 
    {
        if ($this->getValue() == null && !$this->isRequired()) {
            return true;
        }

        foreach ($this->_validators as $validator) {
            if (!$validator->isValid($this->getValue())) {
                Utils::log("Field " . $this->getName() . " is invalid");
                return false;
            }
        }

        return true;
    }

    public function getName() 
    {
        return $this->_name;
    }

    public function setName($name) 
    {
        $this->_name = $name;
    }

    public function setValue($value) 
    {
        $this->_value = $value;
    }

    public function getValue() 
    {
        return $this->_value;
    }

}