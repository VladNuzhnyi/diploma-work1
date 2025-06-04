<?php


namespace App\Http\Logic\Exceptions\Deposit;


class MinDayCountException extends \Exception
{

    protected $code = 409;
    protected $message = "You can't create ad for less then one day.";

}
