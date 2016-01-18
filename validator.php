<?php
/**
 * Validator class
 *
 * Author: Hanna Söderström
 * Email:  info@hannasoderstrom.com
 *
 * Rules
 *
 * isMinLength - Checks if a string has a minimum of x characters.
 * rule_isMinLength($string, $minLength)
 *
 * isMaxLength - Checks if a string has a maximum of x characters.
 * rule_isMaxLength($string, $maxLength)
 *
 * Matches - Checks if a string matches another.
 * rule_matches($value, $matches)
 *
 * hasNoSpecialChars - Checks that a string has no special characters.
 * rule_hasNoSpecialChars($string)
 *
 * isTimeStamp - Checks that a string is a valid timestamp.
 * rule_isTimeStamp($string)
 *
 * isYearMonth - Checks that a string is made of year and month.
 * rule_isYearMonth($string)
 *
 * isAlphabetic - Checks that a string is alphabetic.
 * rule_isAlphabetic($string)
 *
 * isAlphaNumeric - Checks that a string is alphanumeric.
 * rule_isAlphaNumeric($string)
 *
 * isDigit - Checks that a string has only digits.
 * rule_isDigit($digit)
 *
 * isEmail - Checks that a string is an email.
 * rule_isEmail($string)
 *
 * isUrl - Checks that a string is an URL.
 * rule_isUrl($string)
 *
 * isName - Checks that a string is a name (only space and letters)
 * rule_isName($string)
 *
 * html - Escapes a string so that it can safely be used in HTML.
 *
 */
class Validator
{

   /**
    * Rule - Requires string of minimum length.
    * @param string $string
    * @param integer $minLength
    * @return boolean
    */
    static public function rule_isMinLength($string, $minLength)
    {
       if ($string AND strlen(trim($string)) < $minLength) {
           return false;
       }
       return true;
    }

   /**
    * Rule - Requires string of maximum length.
    * @param string $string
    * @param integer $maxLength
    * @return boolean
    */
    static public function rule_isMaxLength($string, $maxLength)
    {
       if ($string AND strlen(trim($string)) > $maxLength) {
           return false;
       }
       return true;
    }

   /**
    * Rule - Requires value to match another value
    * @param mixed $value
    * @param mixed $matches
    * @return boolean
    */
    public static function rule_matches($value, $matches)
    {
       if ($value === $matches) {
           return true;
       }
       return false;
    }

   /**
    * Rule - Requires string has no special characters
    * Not allowed: \ ' ^ £ $ % & * } { @ # ~ > < > | = _ + ¬
    * @param string $string
    * @return boolean
    */
    public static function rule_hasNoSpecialChars($string)
    {
       if (preg_match('/[\'^£$%&*}{@#~><>|=_+¬]/', $string))
       {
           return false;
       }
       return true;
    }

   /**
    * Rule - Requires string is Timestamp (YYYY-MM-DD)
    * @param string $date
    * @return boolean
    */
    public static function rule_isTimeStamp($date)
    {
       if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
           return true;
       }
       return false;
    }

   /**
    * Rule - Requires string is Year (YYYY)
    * @param string $year
    * @return boolean
    */
    public static function rule_isYearMonth($year)
    {
       if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $year)) {
           return true;
       }
       return false;
    }

   /**
    * Rule - Requires string is alphabetic (A-Za-z)
    * @param string $string
    * @return boolean
    */
    public static function rule_isAlphabetic($string)
    {
       $string = str_replace(' ', '', $string); // Remove spaces
       return ctype_alpha($string);
    }

   /**
    * Rule - Requires string is alphanumeric (A-Za-z0-9)
    * @param string $string
    * @return boolean
    */
    public static function rule_isAlphaNumeric($string)
    {
       return ctype_alnum($string);
   }

   /**
    * Rule - Requires string is digit(s) (0-9)
    * @param string $digit
    * @return boolean
    */
    public static function rule_isDigit($digit)
    {
       return ctype_digit($digit);
    }

   /**
    * Rule - Requires string to be email
    */
    public static function rule_isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

   /**
    *  Rule - Requires string to be URL (http(s) or ftp)
    */
    public static function rule_isUrl($string)
    {
        if ( preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $string) )
        {
            return true;
        }
        return false;
    }

   /**
    *  Rule - Requires string to be a name
    *  (only letters and space allowed)
    */
    public static function rule_isName($string)
    {
        if ( preg_match("/^[a-zA-Z ]*$/", $string) )
        {
            return true;
        }
        return false;
    }

   /**
    * Rule - Requires value is unique in specific table and column
    * @param Database $databaseHandler
    * @param string $table
    * @param string $column
    * @param mixed $value
    * @return boolean
    */
    public static function rule_checkUnique($databaseHandler, $table, $column, $value)
    {
       $db = $databaseHandler->getInstance();
       if ($db->query("SELECT * FROM " . $table . " WHERE " . $column . " = ?", [$value])->count()) {
           return false;
       }
       return true;
    }

   /**
    *  Escapes a string so that it can be safely used in HTML
    */
    public static function html($string, $return = false)
    {
        $clean = htmlentities($string, ENT_QUOTES, 'UTF-8');
        if ($return) {
            return $clean;
        } else {
            echo $clean;
        }
    }
}
