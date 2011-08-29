<?php
/** 
 * @see Data_Campaign
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Entities_Field extends Entities_Field_Abstract
{

    public function __construct($name, $required = false, 
                                $validators = array(), $value = NULL ) 
    {
        parent::__construct($name, $required, $value, $validators);
    }

}