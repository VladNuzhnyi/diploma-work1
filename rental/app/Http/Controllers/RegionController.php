<?php


namespace App\Http\Controllers;


use App\Http\DAL\Models\Region;

class RegionController
{

    public function getRegions(){
        return Region::all();
    }

}
