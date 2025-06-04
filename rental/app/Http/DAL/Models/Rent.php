<?php


namespace App\Http\DAL\Models;


use App\Http\Logic\Exceptions\Rent\DatesReservedException;
use App\Http\Logic\Exceptions\Rent\RentExpiredException;
use App\Http\Logic\Exceptions\User\AccessDeniedException;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rent extends Model
{

    /**
     * @param $ad_id
     * @param $date_from
     * @param $date_to
     * @param $item_renter_id
     * @return Rent
     * @throws DatesReservedException
     */
    public static function create($ad_id, $date_from, $date_to, $item_renter_id){

        Rent::validateUniqueReservation($ad_id,$date_from, $date_to);
        $rent = new Rent();
        $ad = Ad::find($ad_id);
        $rent->ad_id = $ad->id;
        $rent->item_owner_id = $ad->user_id;
        $rent->item_renter_id = $item_renter_id;
        $rent->date_rent_from = date('Y-m-d H:i:s',strtotime($date_from));
        $rent->date_rent_to = date('Y-m-d H:i:s',strtotime($date_to));
        $rent->one_day_price = $ad->one_day_price;
        $rent->deposit = $ad->deposit;
        $rent->invoice_nr = rand(10000,99999);
        $rent->status_id = 1;
        $rent->rent_item_title = $ad->item_title;
        $rent->save();
        return $rent;
    }


    public function setRentAmount(){
        $countOfDays = floor((strtotime($this->date_rent_to) - strtotime($this->date_rent_from) )/3600/24);
        $this->rent_sum = $countOfDays * $this->one_day_price;
    }

    public function setTotal(){
        $this->total_sum = $this->rent_sum + $this->deposit;
    }

    /**
     * @param $date_from
     * @param $date_to
     * @throws DatesReservedException
     */
    public static function validateUniqueReservation($ad_id, $date_from, $date_to){
        $r = Rent::where([
            ['date_rent_from', "<=", date('Y-m-d H:i:s',strtotime($date_from))],
            ['date_rent_to', '>=', date('Y-m-d H:i:s',strtotime($date_from))],
            ['status_id','!=','3'],
            ['ad_id', $ad_id]
        ])->orWhere([
            ['date_rent_from', "<=", date('Y-m-d H:i:s',strtotime($date_to))],
            ['date_rent_to', '>=', date('Y-m-d H:i:s',strtotime($date_to))],
            ['status_id','!=','3'],
            ['ad_id', $ad_id]
        ])->orWhere([
            ['date_rent_from', ">=", date('Y-m-d H:i:s',strtotime($date_from))],
            ['date_rent_to', '<=', date('Y-m-d H:i:s',strtotime($date_to))],
            ['status_id','!=','3'],
            ['ad_id', $ad_id]
        ])->get();

        if(count($r)){
            throw new DatesReservedException();
        }
    }


    /**
     * @return bool
     * @throws RentExpiredException
     */
    public function approveRent(){
        if($this->status_id === 3){
            throw new RentExpiredException();
        }
        $this->status_id =2 ;
        return $this->save();
    }

    public static function removeExpiredReservations(){
        $twentyMinutesAgo = date('Y-m-d H:i:s', time() - (20*60) );
        $rents = Rent::where([
            ['status_id', '1'],
            ['created_at', '<=', $twentyMinutesAgo]
        ])->update(['status_id' => 3]);
        return;
    }

    public static function getWithImages($user_id){
        $rents = Rent::notArchived()->where('item_renter_id',$user_id)
            ->with('ad:id')
            ->with('status:id,status_text')
            ->with('item_owner:id,name,second_name')
            ->get([
                'id',
                'date_rent_from',
                'date_rent_to',
                'rent_item_title',
                'status_id',
                'ad_id',
                'item_owner_id',
                'one_day_price'
            ]);
        foreach ($rents as $rent){
            $images = AdImages::where('ads_id',$rent->ad->id)->get(['id','img_name_hash']);
            $rent->images = $images;
        }
        return $rents;
    }

    public static function getRentInfoWithContext(int $rent_id, int $user_id){
        $rent = Rent::where([['id', $rent_id], ['item_renter_id', $user_id]])
            ->with('item_owner:id,name,second_name')
            ->with('ad.region')
            ->get();
       if(!count($rent)){
           throw new AccessDeniedException();
       }
        return $rent;
    }

    public static function notArchived(){
        return Rent::where('status_id','!=','3');
    }

    public function status(){
        return $this->belongsTo("App\Http\DAL\Models\RentStatus",'status_id');
    }

    public function item_owner(){
        return $this->belongsTo("App\Http\DAL\Models\User", 'item_owner_id');
    }

    public function item_renter(){
        return $this->belongsTo("App\Http\DAL\Models\User", 'item_renter_id');
    }

    public function ad(){
        return $this->belongsTo("App\Http\DAL\Models\Ad", 'ad_id');
    }
}
