<?php
/**
 * Inherits from Entity_Validator_Choice and check that
 * field value always apply constraint from two variants "Yes" or "No"
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Validator_YesNo extends Entities_Validator_Choice
{

    public function __construct() 
    {
        parent::__construct(array("Yes", "No"));
    }

}
