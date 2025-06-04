<?php


namespace App\Http\Controllers;

use App\Http\Logic\Exceptions\Deposit\MinDayCountException;
use App\Http\Logic\Exceptions\Deposit\MinDepositAmountException;
use App\Http\Logic\Exceptions\Deposit\TitleNotPass;
use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\ServiceInterfaces\AdServiceInterface;
use Illuminate\Http\Request;

class AdController extends Controller
{


    private $adService;

    public function __construct(AdServiceInterface $adService)
    {
        $this->adService = $adService;
    }

    public function createAd(Request $request){
        try {
            $this->adService->createAd($request->all());
        }catch (ValidationException $exception){
            return response(["errors" =>$exception->errors()],422);
        } catch (MinDayCountException $e) {
            return response($e->getMessage(), $e->getCode());
        } catch (MinDepositAmountException $e) {
            return response($e->getMessage(), $e->getCode());
        } catch (TitleNotPass $e) {
            return response($e->getMessage(), $e->getCode());
        }
        return response('created',201);
    }

    public function getAds(Request $request){
        try {
            $ads = $this->adService->getAds($request->all());
        }catch (ValidationException $validator){
            return response(["errors" =>$validator->errors()],422);
        }
        return $ads;
    }

    public function getAd(Request $request, int $id){
        $ad = $this->adService->getAd(intval($id),$request->user_id);
        return $ad;
    }

}
