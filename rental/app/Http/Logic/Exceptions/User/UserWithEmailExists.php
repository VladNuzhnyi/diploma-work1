<?php


namespace App\Http\Logic\Exceptions\User;


class UserWithEmailExists extends \Exception
{

    protected $message = "User with such email exists";
    protected $code = 409;

}
