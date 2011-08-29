<?php
class Data_Campaign_TimeTarget extends Entities_Abstract
{

    public function __construct() 
    {
        $this->addField(
            new Entities_Field(
                "ShowOnHolidays", false,
                array(new Entities_Validator_YesNo())
            )
        );
        $this->addField(
            new Entities_Field(
                "HolidaysShowFrom", false,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "HolidaysShowTo", false,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "TimeZone", true
            )
        );
        $this->addField(
            new Entities_Field_Array(
                "DaysHours", true
            )
        );
    }

}