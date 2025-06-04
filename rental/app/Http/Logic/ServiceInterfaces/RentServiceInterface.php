<?php


namespace App\Http\Logic\ServiceInterfaces;


use Illuminate\Database\Eloquent\Model;

interface RentServiceInterface
{
    public function getUserRents(int $user_id);
    public function getRentInfo(int $rent_id, int $user_id);
    public function createInvoice(array $fields, int $user_id):string;
    public function getInvoice(int $invoice_nr, int $user_id):Model;
    public function approveRent(int $invoice_nr, int $user_id):void;
}
