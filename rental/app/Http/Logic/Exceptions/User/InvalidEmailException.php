<?php


namespace App\Http\Logic\Exceptions\User;


class InvalidEmailException extends \Exception
{
    protected $message = "invalid email format";
    protected $code = 400;
}
