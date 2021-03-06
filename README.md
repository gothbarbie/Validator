# Validator
A (static) PHP validator class. Lets you validate data according to different sets of rules, listed below.

## Rules

### minLength
*minLength($string, $max)*
Checks if a string has a minimum of x characters.
```php
<?php
$name = "Hanna";
if (Validator::isMinLength($name, 3)) echo "Valid";
?>
```

### maxLength
*maxLength($string, $max)*

Checks if a string has a maximum of x characters.
```php
<?php
$name = "Hanna";
if (!Validator::isMaxLength($name, 3)) echo "Name is too long (maximum 3 characters), use a shorter name";
?>
```

### matches
*matches($string, $matches)*

Checks if a string matches another.
```php
<?php
$name    = "Hanna";
$matches = "Hanna";
if (Validator::matches($name, $matches)) {
    echo "Name matches";    
} else {
    echo "Name is not valid";
}
?>
```

### hasNoSpecialChars
*hasNoSpecialChars($string)*

Checks that a string has no special characters: [\'^£$%&*}{@#~><>|=_+¬]
```php
<?php
$string = "<script>window.alert("Hello");</script>";
if (Validator::hasNoSpecialChars($string)) {
    echo "Contains invalid characters!";    
}
?>
```

### timeStamp
*timeStamp($string)*

Checks that a string is a valid timestamp.
```php
<?php
$timestamp = "2016-02-15";
if (Validator::isTimeStamp($timestamp)) {
    echo "This is a valid timestamp.";    
}
?>
```

### yearMonth
*yearMonth($string)*

Checks that a string is made of year and month.
```php
<?php
$yearMonth = "2016-02";
if (Validator::isYearMonth($yearMonth)) {
    echo "This is a valid.";    
}
?>
```

### alphabetic
*alphabetic($string)*

Checks that a string is alphabetic.
```php
<?php
$string = "2016-02";
if (!Validator::isAlphabetic($string)) {
    echo "Must contain _letters_ only."
}
?>
```

### alphaNumeric
*alphaNumeric($string)*

Checks that a string is alphanumeric.
```php
<?php
$string = "Month12";
if (Validator::isAlphaNumeric($string)) {
    echo "This is a valid string.";
}
?>
```

### digit
*digit($string)*

Checks that a string has only digits.
```php
<?php
$string = "12345";
if (Validator::isDigit($string)) {
    echo "This is a valid string.";
}
?>
```

### email
*email($string)*

Checks that a string is an email.
```php
<?php
$string = "info@hannasoderstrom.com";
if (Validator::isEmail($string)) {
    echo "This is a valid email.";
}
?>
```

### url
*URL($string)*

Checks that a string is an URL.
```php
<?php
$string = "http://www.hannasoderstrom.com";
if (Validator::isUrl($string)) {
    echo "This is a valid URL.";
}
?>
```

### name
*name($string)*

Checks that a string is a name (only space and letters)
```php
<?php
$string = "Hanna Söderström";
if (Validator::isName($string)) {
    echo "This is a valid name.";
}
?>
```


## Escaping

### html
*html($string)*

Escapes a string so that it can safely be used in HTML.
```php
<p>Name: <?php Validator::html($name); ?></p>
```

## Author
* Hanna Söderström
* info@hannasoderstrom.com
