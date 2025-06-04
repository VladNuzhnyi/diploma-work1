<?php


namespace App\Http\Logic\Validators;


use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\lib\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class CreateUserValidator implements ValidatorInterface
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
            "name" => "required|min:1",
            "second_name" => "required|min:1",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8",
        ]);

        if($validator->fails()){
            throw new ValidationException($validator->errors());
        }

    }
}
