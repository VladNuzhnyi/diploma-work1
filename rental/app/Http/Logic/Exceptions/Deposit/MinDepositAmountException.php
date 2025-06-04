<?php


namespace App\Http\Logic\Exceptions\Deposit;


class MinDepositAmountException extends \Exception
{
    protected $code = 409;
    protected $message = "You can't make ad with such amount.";
}
