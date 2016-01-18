# Validator
A PHP validator class. Lets you validate data according to different sets of rules, listed below.

## Rules

### isMinLength
*rule_isMinLength($string, $max)*
Checks if a string has a minimum of x characters.

### isMaxLength
*rule_isMaxLength($string, $max)*

Checks if a string has a maximum of x characters.

### matches
*rule_matches($string, $matches)*

Checks if a string matches another.

### hasNoSpecialChars
*rule_hasNoSpecialChars($string)*

Checks that a string has no special characters.

### isTimeStamp
*rule_isTimeStamp($string)*

Checks that a string is a valid timestamp.

### isYearMonth
*rule_isYearMonth($string)*

Checks that a string is made of year and month.

### isAlphabetic
*rule_isAlphabetic($string)*

Checks that a string is alphabetic.

### isAlphaNumeric
*rule_isAlphaNumeric($string)*

Checks that a string is alphanumeric.

### isDigit
*rule_isDigit($string)*

Checks that a string has only digits.

### isEmail
*rule_isEmail($string)*

Checks that a string is an email.

### isUrl
*rule_isURL($string)*

Checks that a string is an URL.

### isName
*rule_isName($string)*

Checks that a string is a name (only space and letters)


## Escaping

### html
*html($string)*

Escapes a string so that it can safely be used in HTML.

## Author
* Hanna Söderström
* info@hannasoderstrom.com
