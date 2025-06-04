<?php


namespace App\Http\Logic\Validators;


use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\lib\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class LoginUserValidator implements ValidatorInterface
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
            "email" => "required|string",
            "password" => "required|string",
        ]);

        if($validator->fails()){
            throw new ValidationException($validator->errors());
        }

    }
}
