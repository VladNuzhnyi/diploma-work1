<?php


namespace App\Http\Logic\Exceptions\User;


class InvalidPasswordException extends \Exception
{

    protected $code = 409;
    protected $message = "Password don't much.";

}
