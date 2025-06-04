<?php


namespace App\Http\Logic\Exceptions;


class ValidationException extends \Exception
{

    protected $message = 'Validation exception';
    private $errors = [];

    public function __construct($options = array('params'))
    {
        $message="Validation exception";
        $code = 0;
        $previous = null;
        parent::__construct($message, $code, $previous);
        $this->errors = $options;
    }


    public function errors() { return $this->errors; }

}
