<?php
final class StringUtils
{

    public static $caseDelimiters = array("_", "-");

    function lastIndexOf($haystack, $needle) 
    {
        $index = strpos(strrev($haystack), strrev($needle));
        $index = strlen($haystack) - strlen($needle) - $index;
        return $index;
    }

    function selectBetween($haystack, $start, $end) 
    {
        return substr($haystack, $start, $end - strlen($haystack) + 1);
    }

    public static function startsWith($value, $token) 
    {
        return strpos($value, $token) === 0;
    }

    public static function endsWith($value, $token) 
    {
        return ( strpos($value, $token) + strlen($token) ) == strlen($value);
    }

    /**
     * Camelize input string
     * @param name Input string
     * @param ucfirst Make first character uppercased
     * @return String
     */
    public static function toCamelCase($name, $ucfirst = false) 
    {
        $result = "";
        for ($i = 0; $i < strlen($name); $i++) {
            $prevChar = substr($name, $i > 0 ? $i - 1 : 0, $i > 0 ? $i : 1);
            $currChar = substr($name, $i, $i + 1);

            if (in_array($prevChar, StringUtils::$caseDelimiters)
                    || ( $ucfirst && $i == 0
                    && !in_array($currChar, StringUtils::$caseDelimiters) )) {
                $result .= ucfirst($currChar);
            } else if (!in_array($currChar, StringUtils::$caseDelimiters)) {
                $result .= $currChar;
            }
        }

        return $result;
    }

    public static function fromCamelCase($name, $delimiter) 
    {
        $result = "";
        $lastDelimiterPos = 0;
        for ($i = 0; $i < strlen($name); $i++) {
            $currChar = substr($name, $i, $i + 1);

            if (ucfirst($currChar) == $currChar
                    && $i != $lastDelimiterPos - 1) {
                if ($i > 0) {
                    $result .= $delimiter;
                    $lastDelimiterPos = i;
                }

                $result .= lcfirst($currChar);
            } else {
                $result .= lcfirst($currChar);
            }
        }

        return $result;
    }

}