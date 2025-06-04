<?php


namespace App\Http\Logic\Services;


use App\Http\DAL\Models\Rent;
use App\Http\Logic\Exceptions\Rent\DatesReservedException;
use App\Http\Logic\Exceptions\Rent\RentExpiredException;
use App\Http\Logic\ServiceInterfaces\RentServiceInterface;
use App\Http\Logic\Validators\CreateRentValidator;
use App\Http\Logic\Validators\GetInvoiceValidator;
use Illuminate\Database\Eloquent\Model;
use App\Http\Logic\Exceptions\User\AccessDeniedException;

class RentService implements RentServiceInterface
{

    public function getUserRents(int $user_id)
    {
        return Rent::getWithImages($user_id);
    }

    /**
     * @param array $fields
     * @param int $user_id
     * @return string
     * @throws DatesReservedException
     * @throws \App\Http\Logic\Exceptions\ValidationException
     */
    public function createInvoice(array $fields, int $user_id): string
    {
        $v = new CreateRentValidator($fields);
        $v->validate();

        $rent = Rent::create(
            $fields["ad_id"],
            $fields["date_from"],
            $fields["date_to"],
            $user_id
        );

        return $rent->invoice_nr;
    }

    /**
     * @param int $invoice_nr
     * @return Model
     * @throws \App\Http\Logic\Exceptions\ValidationException
     */
    public function getInvoice(int $invoice_nr, int $user_id): Model
    {
        $validator = new GetInvoiceValidator($invoice_nr);
        $validator->validate();

        $rent = Rent::where('invoice_nr',$invoice_nr)
            ->where('item_renter_id', $user_id)
            ->with('item_owner')
            ->with('item_renter')
            ->first();
        $rent->setRentAmount();
        $rent->setTotal();
        return $rent;
    }

    public function getRentInfo(int $rent_id, int $user_id)
    {
        try {
            return Rent::getRentInfoWithContext($rent_id, $user_id);
        } catch (AccessDeniedException $exception) {
            throw $exception;
        }
    }

    /**
     * @param $user_id
     * @throws \App\Http\Logic\Exceptions\ValidationException
     * @throws RentExpiredException
     */
    public function approveRent(int $invoice_nr,int $user_id): void
    {
        $validator = new GetInvoiceValidator($invoice_nr);
        $validator->validate();

        $rent = Rent::where('invoice_nr',$invoice_nr)
            ->where('item_renter_id', $user_id)
            ->first();

        $rent->approveRent();
    }
}
