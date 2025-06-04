<?php


namespace App\Http\Logic\Validators;


use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\lib\ValidatorInterface;
use Illuminate\Support\Facades\Validator;

class GetInvoiceValidator implements ValidatorInterface
{

    private $invoice_nr;

    public function __construct($invoice_nr)
    {
        $this->invoice_nr = $invoice_nr;
    }

    /**
     * @throws ValidationException
     */
    public function validate(): void
    {
        $v = Validator::make(["invoice_nr" => $this->invoice_nr],[
            "invoice_nr" => "required|numeric|exists:rents,invoice_nr"
        ]);

        if($v->fails()){
            throw new ValidationException($v->errors());
        }
    }
}
