<?php
class Data_Campaign_SMSNotification extends Entities_Abstract
{

    public function __construct() 
    {
        $this->addField(new Entities_Field("MetricaSms", false));
        $this->addField(new Entities_Field("ModerateResultSms", false));
        $this->addField(new Entities_Field("MoneyInSms", false));
        $this->addField(new Entities_Field("smsTimeFrom", false));
    }

}
