<?php


namespace App\Http\Logic\Exceptions\Rent;


class DatesReservedException extends \Exception
{

    protected $message = 'You can\'t make reservation at this dates.';

}
