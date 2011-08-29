<?php
class Data_Campaign_EmailNotification extends Entities_Abstract
{
    
    public static $intervalHour = 60;
    public static $intervalHalfHour = 30;
    public static $intervalQuaterHour = 15;

    public function __construct() 
    {
        $this->addField(
            new Entities_Field("Email", true)
        );
        
        $this->addField(
            new Entities_Field(
                "WarnPlaceInterval", true,
                array(new Entities_Validator_Numeric())
            )
        );
        
        $this->addField(
            new Entities_Field(
                "MoneyWarningValue", true,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "SendAccNews", false,
                array(new Entities_Validator_YesNo())
            )
        );
        $this->addField(
            new Entities_Field(
                "SendWarn", false,
                array(new Entities_Validator_YesNo())
            )
        );
    }

}
