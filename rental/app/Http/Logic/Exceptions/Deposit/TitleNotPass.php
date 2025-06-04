<?php


namespace App\Http\Logic\Exceptions\Deposit;


class TitleNotPass extends \Exception
{

    protected $message = "Title is too short";
    protected $code = 409;

}
