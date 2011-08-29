<?php
/**
 * Validator to check that field value always
 * not equals to null.
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Validator_NotNull implements Entities_Validator_Interface
{

    public function isValid($data) 
    {
        return $data != null;
    }

}