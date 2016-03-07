<?php
/**
 * Validator class
 *
 * Author: Hanna Söderström
 * Email:  info@hannasoderstrom.com
 *
 * Rules
 *
 * MinLength - Checks if a string has a minimum of x characters.
 * MinLength($string, $minLength)
 *
 * MaxLength - Checks if a string has a maximum of x characters.
 * MaxLength($string, $maxLength)
 *
 * Matches - Checks if a string matches another.
 * matches($value, $matches)
 *
 * hasNoSpecialChars - Checks that a string has no special characters.
 * hasNoSpecialChars($string)
 *
 * TimeStamp - Checks that a string  a valid timestamp.
 * TimeStamp($string)
 *
 * YearMonth - Checks that a string  made of year and month.
 * YearMonth($string)
 *
 * Alphabetic - Checks that a string  alphabetic.
 * Alphabetic($string)
 *
 * AlphaNumeric - Checks that a string  alphanumeric.
 * AlphaNumeric($string)
 *
 * Digit - Checks that a string has only digits.
 * Digit($digit)
 *
 * Email - Checks that a string  an email.
 * Email($string)
 *
 * Url - Checks that a string  an URL.
 * Url($string)
 *
 * Name - Checks that a string  a name (only space and letters)
 * Name($string)
 *
 * html - Escapes a string so that it can safely be used in HTML.
 *
 * isJson - Checks if a variable is valid JSON-format or not.
 */
class Validator
{
   /**
    * Rule - Requires string of minimum length.
    * @param string $string
    * @param integer $minLength
    * @return boolean
    */
    static public function minLength($value, $requirement)
    {
        return mb_strlen($value) >= $requirement;
    }

   /**
    * Rule - Requires string of maximum length.
    * @param string $string
    * @param integer $maxLength
    * @return boolean
    */
    static public function maxLength($value, $requirement)
    {
        return mb_strlen($value) <= $requirement;
    }

   /**
    * Rule - Requires value to match another value
    * @param mixed $value
    * @param mixed $matches
    * @return boolean
    */
    public static function matches($value, $requirement)
    {
       if ($value === $requirement) {
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
    public static function hasNoSpecialChars($value)
    {
       if (preg_match('/[\'^£$%&*}{@#~><>|=_+¬]/', $value))
       {
           return false;
       }
       return true;
    }

   /**
    * Rule - Requires string  Timestamp (YYYY-MM-DD)
    * @param string $date
    * @return boolean
    */
    public static function timeStamp($value)
    {
       if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $value)) {
           return true;
       }
       return false;
    }

   /**
    * Rule - Requires string  Year (YYYY)
    * @param string $year
    * @return boolean
    */
    public static function yearMonth($value)
    {
       if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $value)) {
           return true;
       }
       return false;
    }

   /**
    * Rule - Requires string  alphabetic (A-Za-z)
    * @param string $string
    * @return boolean
    */
    public static function alphabetic($value)
    {
       $value = str_replace(' ', '', $value); // Remove spaces
       return ctype_alpha($value);
    }

   /**
    * Rule - Requires string  alphanumeric (A-Za-z0-9)
    * @param string $string
    * @return boolean
    */
    public static function alphaNumeric($value)
    {
       return ctype_alnum($value);
   }

   /**
    * Rule - Requires string  digit(s) (0-9)
    * @param string $digit
    * @return boolean
    */
    public static function digit($value)
    {
       return ctype_digit($value);
    }

   /**
    * Rule - Requires string to be email
    */
    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

   /**
    *  Rule - Requires string to be URL (http(s) or ftp)
    */
    public static function url($value)
    {
        if ( preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value) )
        {
            return true;
        }
        return false;
    }

   /**
    *  Rule - Requires string to be a name
    *  (only letters and space allowed)
    */
    public static function name($value)
    {
        if ( preg_match("/^[a-zA-Z ]*$/", $value) )
        {
            return true;
        }
        return false;
    }

   /**
    *  Rule - Item  required
    */
    public static function required($value)
    {
        return !empty(trim($value));
    }


   /**
    * Rule - Requires value  unique in specific table and column
    * @param Database $databaseHandler
    * @param string $table
    * @param string $column
    * @param mixed $value
    * @return boolean
    */
    public static function checkUnique($databaseHandler, $table, $column, $value)
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

    public static function isJson($string)
    {
        if (!is_array($string) && json_decode($string)) {
            return (json_last_error() == JSON_ERROR_NONE);
        }
        return false;
    }
}
