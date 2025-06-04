<?php


namespace App\Http\Logic\Exceptions\Deposit;


class DepositLessThenOne extends \Exception
{
    protected $message = "You can't make ad with such deposit.";
    protected $code = 409;
}
