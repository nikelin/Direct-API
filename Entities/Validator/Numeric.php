<?php
/**
 * Numeric validator check that field value is
 * always numeric.
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Validator_Numeric implements Entities_Validator_Interface
{

    public function isValid($data) 
    {
        return is_numeric($data);
    }

}