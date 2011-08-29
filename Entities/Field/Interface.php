<?php
/**
 * General interface to represent data object fields.
 * 
 * @see Entity_Interface
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
interface Entities_Field_Interface
{

    /**
     * Return true is value of this field must not be
     * null.
     * 
     * @return bool
     */
    public function isRequired();
    
    /**
     * Return current field name
     * 
     * @return string
     */
    public function getName();

    /**
     * Return current field value
     * 
     * @see Entity_Field_Array
     * @see Entity_Field_Reference
     * @see Entity_Field
     * @return mixed Depends on concrete interface implementation
     */
    public function getValue();

    /**
     * Set value to current field
     * 
     * @param mixed $value
     * @return
     */
    public function setValue($value);

    /**
     * Add new validator which will be applyed to
     * a field value to check it's validity during
     * request validation on Connection_Interface::invoke(...)
     * 
     * @param $validator Entities_Validator_Interface
     * @return
     */
    public function addValidator(Entities_Validator_Interface $validator);

    /**
     * Invoke all applyed validators and return
     * result of it's invokation.
     * 
     * @return bool
     */
    public function isValid();
}