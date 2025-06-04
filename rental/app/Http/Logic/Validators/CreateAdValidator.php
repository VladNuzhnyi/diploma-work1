<?php


namespace App\Http\Logic\Validators;


use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\lib\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class CreateAdValidator implements ValidatorInterface
{
    private $fields = [];
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function validate(): void
    {
        $validator = Validator::make($this->fields, [
            'title' => 'required|max:255',
            'min_day_count' => 'required|integer',
            'daily_price'=> 'required|numeric|min:1',
            'allow_sending_to_other_city'=> 'required|bool',
            'category'=> 'required|numeric|max:255',
            'address'=> 'required|max:255',
            'description'=> 'required|max:255',
            'region'=> 'required|numeric|max:255',
            'deposit'=> 'nullable|numeric|min:1',
        ]);

        if($validator->fails()){
            throw new ValidationException(
                $validator->errors()
            );
        }
    }

}
