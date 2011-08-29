<?php
/**
 * Return true if value laying under
 * validator defined constraint
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Validator_Choice implements Entities_Validator_Interface
{

    public function __construct(array $choices = array()) 
    {
        $this->choices = $choices;
    }

    public function isValid($value) 
    {
        return in_array($value, $this->choices);
    }

}
