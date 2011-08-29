<?php
class Data_Campaign_Strategy extends Entities_Abstract
{

    public function __construct() 
    {
        $this->addField(
            new Entities_Field(
                "MaxPrice", false,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "AveragePrice", false,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "WeeklySumLimit", false,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "ClicksPerweek", false,
                array(new Entities_Validator_Numeric())
            )
        );
        $this->addField(
            new Entities_Field(
                "StrategyName", true
            )
        );
    }

}
