<?php


namespace App\Http\Logic\Exceptions\User;


class NoUserWithSuchEmail extends \Exception
{

    protected $code = 409;
    protected $message = "User with this email does not exists.";

}
