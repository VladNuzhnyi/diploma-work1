<?php


namespace App\Http\Logic\lib;


use App\Http\Logic\Exceptions\ValidationException;

interface ValidatorInterface
{
    public function __construct($fields);
    public function validate():void;

}
