<?php
class Entities_Field_Reference extends Entities_Field_Abstract
{

    public function __construct($name, $class, $required = false) 
    {
        parent::__construct($name, $required, new $class(), array());

        if (!( $this->getValue() instanceof Entities_Interface )) {
            throw new Entities_Exception("Invalid reference field value!");
        }
    }

    /**
     * @see Countable::count()
     * @return type 
     */
    public function count() 
    {
        return count($this->value);
    }

    /**
     * @see Entity_Field::isValid()
     * @return type 
     */
    public function isValid() 
    {
        if (!$this->isRequired() && $this->getValue() == null) {
            return true;
        }

        foreach ($this->getValue()->getFields() as $field) {
            if (!$field->isValid()) {
                Utils::log("Field " . $field->getName() . " is invalid");
                return false;
            }
        }

        return true;
    }

}