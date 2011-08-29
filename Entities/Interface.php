<?php
/**
 * Interface for all data entities which
 * can be used as API gateway data.
 *
 * @see Connection_Protocol_JSON
 * @see Entities_Validator_Interface
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
interface Entities_Interface
{

    /**
     * Return entity field values in a map
     * representation
     *            
     * @return array
     */
    public function getFields();
    
}
