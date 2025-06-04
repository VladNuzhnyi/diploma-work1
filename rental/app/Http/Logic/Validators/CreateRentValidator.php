<?php


namespace App\Http\Logic\Validators;


use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\lib\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class CreateRentValidator implements ValidatorInterface
{

    private $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $validator = Validator::make($this->fields, [
            "ad_id" => "required|numeric|min:1|exists:ads,id",
            "date_from" => "required|date|after:today",
            "date_to" => "required|date|after:date_from",
        ]);

        if($validator->fails()){
            throw new ValidationException($validator->errors());
        }
    }
}
