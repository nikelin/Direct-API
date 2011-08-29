<?php
/**
 * @see Data_Campaign
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Utils
{

    function jsonDecode($json) 
    {
        return json_decode($json, true);
    }

    public static function log($message) 
    {
        if (DEBUG) {
            echo var_dump($message);
        }
    }

    public static function ifsetor(&$value, $otherwise) 
    {
        if (!isset($value) || $value == NULL) {
            return $otherwise;
        }

        return $value;
    }

}
