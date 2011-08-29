<?php
class Data_Campaign extends AbstractEntity
{
    public static $contextDefault = "Default";
    public static $contextLimited = "Limited";

    public function __construct() 
    {
        $this->addField(new Field("Login", true));
        $this->addField(new Field("Name", true));
        $this->addField(new Field("FIO", true));
        $this->addField(
            new Field(
                "CampaignID", true,
                array(new NumericValidator())
            )
        );
        $this->addField(new Field("StartDate", true));
        $this->addField(new Field("ContextLimit", true));
        $this->addField(
            new Field(
                "ContextLimitSum", true,
                array(new NumericValidator())
            )
        );
        $this->addField(new Field("ContextPricePercent", false));
        $this->addField(new Field("AutoOptimization", false));
        $this->addField(new Field("StatusMetricaControl", false));
        $this->addField(new Field("DisabledDomains", false));
        $this->addField(new Field("DisabledIps", false));
        $this->addField(new Field("StatusOpenStat", false));
        $this->addField(
            new Field(
                "ConsiderTimeTarget", false,
                array(new YesNoValidator())
            )
        );
        $this->addField(new ArrayField("MinusKeywords", false));
        $this->addField(
            new Field(
                "RelevantPhrasesBudgetLimit", false,
                array(new NumericValidator())
            )
        );
        $this->addField(new Field("AddRelevantPhrases", false));
        $this->addField(new Field("StatusContextStop", false));
        $this->addField(new Field("StatusBehavior", false));
        $this->addField(
            new ReferenceField(
                "TimeTarget",
                "Campaign_TimeTarget", false
            )
        );
        $this->addField(
            new ReferenceField(
                "Strategy",
                "Campaign_Strategy", true
            )
        );
        $this->addField(
            new ReferenceField(
                "EmailNotification",
                "CampaignNotification_Email", true
            )
        );
        $this->addField(
            new ReferenceField(
                "SmsNotification",
                "CampaignNotification_SMS", false
            )
        );
    }

}