<?php
/**
 * Interface for validation entities which
 * can be given as subject on Entity_Interface::addValidator(...)
 * 
 * @see Entity_Interface
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
interface Entities_Validator_Interface
{

    public function isValid($data);
}