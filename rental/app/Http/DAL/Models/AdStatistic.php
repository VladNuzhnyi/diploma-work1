<?php


namespace App\Http\DAL\Models;


use Illuminate\Database\Eloquent\Model;

class AdStatistic extends Model
{

//    protected $connection='mysql2';

    public function create($ad_id, $user_id){
        $this->ads_id = $ad_id;
        $this->user_id = $user_id;
        $this->save();
    }

}
