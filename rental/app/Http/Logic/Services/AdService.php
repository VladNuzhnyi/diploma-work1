<?php


namespace App\Http\Logic\Services;


use App\Http\DAL\Models\Ad;
use App\Http\DAL\Models\AdStatistic;
use App\Http\Logic\Entity\AdEntity;
use App\Http\Logic\Exceptions\Deposit\MinDayCountException;
use App\Http\Logic\Exceptions\Deposit\MinDepositAmountException;
use App\Http\Logic\Exceptions\Deposit\TitleNotPass;
use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\ServiceInterfaces\AdServiceInterface;
use App\Http\Logic\Validators\CreateAdValidator;
use App\Http\Logic\Validators\GetAdsValidator;
use Illuminate\Database\Eloquent\Model;

class AdService implements AdServiceInterface
{

    /**
     * @param array $fields
     * @throws MinDayCountException
     * @throws MinDepositAmountException
     * @throws TitleNotPass
     * @throws ValidationException
     */
    public function createAd(array $fields):void
    {
        $cav = new CreateAdValidator($fields);
        $cav->validate();

        $entity = new AdEntity(
            $fields["images"],
            $fields["title"],
            $fields["min_day_count"],
            $fields["daily_price"],
            $fields["allow_sending_to_other_city"],
            $fields["category"],
            $fields["address"],
            $fields["description"],
            $fields["region"],
            $fields["user_id"],
            $fields["additional_parameters"],
            $fields["deposit"]
        );
        $model = new Ad();
        $model->create($entity);

    }

    /**
     * @param array $fields
     * @return array
     * @throws ValidationException
     */
    public function getAds(array $fields):array
    {
        $validator = new GetAdsValidator($fields);
        $validator->validate();
        return Ad::filterCategory($fields);
    }

    public function getAd(int $id,?int $user_id):Model
    {
        $ad = Ad::getAdWithContext($id);
        (new AdStatistic())->create($ad->id, $user_id);
        $user = $ad->user->getSecure();
        $ad->user = $user;
        return $ad;
    }
}
