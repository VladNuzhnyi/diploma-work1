<?php


namespace App\Http\Logic\Exceptions\Rent;


class RentExpiredException extends \Exception
{

    protected $message = 'Your reservation expired';

}
