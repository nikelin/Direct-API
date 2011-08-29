<?php
/**
 * Entity fields which can be given as Entity_Interface::addField(...)
 * parameter corresponds to Connection_Protocol_Interface that
 * it's must be rendered as nested entities or simple values array 
 * when sending to API gateway.
 * 
 * @see Data_Campaign
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Field_Array extends Entities_Field_Abstract
{

    public function __construct($name, $required = false, 
                                $validators = array(), $value = array()) 
    {
        parent::__construct($name, $required, $value, $validators);
    }

    public function isValid() 
    {
        foreach ($this->value as $key => $item) {
            if ($item == null && !$this->isRequired()) {
                continue;
            }

            if (!parent::isValid($item)) {
                return false;
            }
        }

        return true;
    }

    public function setValue($value) 
    {
        if (!is_array($value)) {
            throw new Exception("Only array-type values allowed!");
        }

        parent::setValue($value);
    }

}
