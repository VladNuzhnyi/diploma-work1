<?php


namespace App\Http\Logic\ServiceInterfaces;


use Illuminate\Database\Eloquent\Model;

interface AdServiceInterface
{

    public function createAd(array $fields);
    public function getAds(array $fields);
    public function getAd(int $id, ?int $user_id):Model;

}
