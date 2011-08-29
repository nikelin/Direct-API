<?php
class Data_Campaign_TimeTarget_Hours extends Entities_Abstract
{

    public function __construct(array $hours = array(), array $days = array()) 
    {
        $this->addField(
            new Entities_Field_Array(
                "Hours", true,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->{"Hours"} = $hours;
        $this->addField(
            new Entities_Field_Array(
                "Days", true,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->{"Days"} = $days;
    }

}