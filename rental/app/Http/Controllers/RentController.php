<?php


namespace App\Http\Controllers;

use App\Http\Logic\Exceptions\Rent\DatesReservedException;
use App\Http\Logic\Exceptions\Rent\RentExpiredException;
use App\Http\DAL\Models\Rent;
use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\ServiceInterfaces\RentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Logic\Exceptions\User\AccessDeniedException;

class RentController extends Controller
{

    private $rentService;

    public function __construct(RentServiceInterface $rentService)
    {
        $this->rentService = $rentService;
    }

    public function getUserRents(Request $request){
        $rents = $this->rentService->getUserRents($request->user_id);
        return $rents;
    }


    public function getRentInfo(Request $request, int $id){
        try {
            return $this->rentService->getRentInfo($id, $request->user_id);
        }catch (AccessDeniedException $exception){
            return response(["errors" => [$exception->getMessage()]],403);
        }
    }


    public function createInvoice(Request $request){
        try {
            $invoice_nr = $this->rentService->createInvoice($request->all(),$request->user_id);
        }catch (ValidationException $exception){
            return response(["errors" =>$exception->errors()],422);
        }catch (DatesReservedException $exception){
            return response(["errors" =>
                [$exception->getMessage()]
            ],422);
        }
        return response(["invoice_nr"=>$invoice_nr]);
    }

    public function getInvoice(Request $request){
        try {
            $invoice = $this->rentService->getInvoice($request->invoice_nr,$request->user_id);
        }catch (ValidationException $exception){
            return response(["errors" => $exception->errors()],422);
        }
        return $invoice;
    }

    public function approveRent(Request $request){

        try{
            $this->rentService->approveRent($request->invoice_nr,$request->user_id);
        }catch (ValidationException $validator){
            return response(["errors" =>$validator->errors()],422);
        }catch (RentExpiredException $exception){
            return response(["errors" => [$exception->getMessage()]], 403);
        }
        return response("ok",202);
    }

}
