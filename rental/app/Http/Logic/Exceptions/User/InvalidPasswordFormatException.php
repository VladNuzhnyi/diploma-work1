<?php


namespace App\Http\Logic\Exceptions\User;


class InvalidPasswordFormatException extends \Exception
{
    protected $message = "invalid password format";
    protected $code = 400;
}
