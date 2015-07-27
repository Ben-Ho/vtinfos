<?php
/**
 * @package Validate
 */
class Forms_Speaker_Validators_Phone extends Zend_Validate_Abstract
{
    const WRONG_FORMAT = 'wrongFormat';

    public function __construct($allowWhiteSpace = false)
    {
        $this->_messageTemplates[self::WRONG_FORMAT]
            = trlStatic("Bitte Telefonnummer in dieser Form '+43 1234 567890'");
    }

    public function isValid($value)
    {
        $phoneNumber = trim($value);
        if ($phoneNumber && substr($phoneNumber, 0, 1) !== '+') {
            $this->_error(self::WRONG_FORMAT);
            return false;
        }
        return true;
    }
}
