<?php

namespace core;

class Exception extends \Yaf\Exception
{
    const SERVER_ERROR = 1;

    const BAD_CREDENTIAL = 10;

    const METHOD_NOT_ALLOW = 11;

    const NO_PERMISSION = 12;

    const USER_NOT_FOUND = 13;

    const BAD_REQUEST = 14;

    const EMAIL_FORMAT_ERROR = 15;

    const EMAIL_IS_USED = 16;

    const PASSWORD_TOO_SHORT = 17;

    const USER_NOT_SIGNIN = 18;

    const PASSWORD_ERROR = 19;

    const ERROR_LOCATION = 20;

    const NOT_NEW_PLAYER = 21;

    const ERROR_STRUCTURE_TYPE = 22;

    public function __construct($code, $message = null, $previous = null) 
    {
        parent::__construct($message, $code, $previous);
    }
}
