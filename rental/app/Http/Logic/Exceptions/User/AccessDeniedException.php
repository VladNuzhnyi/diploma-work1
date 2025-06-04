<?php


namespace App\Http\Logic\Exceptions\User;


class AccessDeniedException extends \Exception
{
    protected $message = "Access denied";
}
