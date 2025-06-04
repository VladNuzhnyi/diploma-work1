<?php


namespace App\Http\DAL\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdImages extends Model
{

    protected $table = "ads_images";

    public function create(string $img_base64, int $ads_id){
        $this->ads_id = $ads_id;

        $mime = $this->geImageMime($img_base64);
        $data = $this->getContentFromBase64($img_base64);
        $imageName = Str::random().".".$mime;

        $this->img_name_hash = $imageName;

        Storage::disk('local')->put(env("STORAGE_PATH").$imageName,$data);
        $this->save();
    }

    private function geImageMime($base64){
        $split = explode( '/', $base64 );
        $type = explode(';',$split[1])[0];
        return $type;
    }

    private function getContentFromBase64($base64){
        return base64_decode(explode(",",$base64)[1]);
    }

}
