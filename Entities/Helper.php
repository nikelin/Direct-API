<?php
/**
 * @see Data_Campaign
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
final class Entities_Helper
{
    
    public static function createTestCampaignRequest() 
    {
        $dto = new Data_Campaign();
        $dto->setCampaignID(2312);
        $dto->setLogin("kirill-karpenko1");
        $dto->setFIO("Nikelos Nikelo Nikelus");
        $dto->setName("Nikelando Campaign");
        $timeTarget = new Data_Campaign_TimeTarget();
        $timeTarget->setTimeZone("Europe/Moscow");
        $dayHours = array();
        $dayHours[] = new Data_Campaign_TimeTarget_Hours(
            array(1, 2, 3, 4, 5),
            array(1, 2, 3, 4, 5)
        );
        $timeTarget->setDaysHours($dayHours);
        $timeTarget->setShowOnHolidays("No");
        $dto->setTimeTarget($timeTarget);
        // $dto->setStartDate( date("d.m.Y H:i:s") );
        $dto->setContextLimit(Data_Campaign::$contextDefault);
        $strategy = new Data_Campaign_Strategy();
        $strategy->setStrategyName(Data_Campaign_Strategy_Type::$lowestCost);
        $dto->setStrategy($strategy);
        $notification = new Data_Campaign_EmailNotification();
        $notification->setEmail("self@nikelin.ru");
        $notification->setSendWarn(true);
        $notification->setMoneyWarningValue(25);
        $notification->setWarnPlaceInterval(
            Data_Campaign_EmailNotification::$intervalHour
        );
        $dto->setEmailNotification($notification);
        $request = new API_Request_CreateOrUpdateCampaign($dto);
        return $request;
    }
    
}
