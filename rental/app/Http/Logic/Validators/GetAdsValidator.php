<?php


namespace App\Http\Logic\Validators;


use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\lib\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class GetAdsValidator implements ValidatorInterface
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
            "from" => "required|numeric|min:0",
            "size" => "required|numeric|min:2"
        ]);

        if($validator->fails()){
            throw new ValidationException($validator->errors());
        }
    }
}
