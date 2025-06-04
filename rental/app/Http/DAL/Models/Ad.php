<?php


namespace App\Http\DAL\Models;


use App\Http\Logic\Entity\AdEntity;
use App\Http\Logic\Exceptions\Rent\DatesReservedException;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Ad extends Model
{
    public function __construct( array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $casts = [
        'additional_parameters' => 'array'
    ];


    public function user()
    {
        return $this->belongsTo("App\Http\DAL\Models\User", "user_id");
    }

    public function create(AdEntity $adEntity)
    {

        $this->item_title = $adEntity->getTitle();
        $this->min_rent_days = $adEntity->getMinDayCount();
        $this->one_day_price = $adEntity->getDailyPrice();
        $this->description = $adEntity->getDescription();
        $this->region_id = $adEntity->getRegion();
        $this->category_id = $adEntity->getCategory();
        $this->address = $adEntity->getAddress();
        $this->additional_parameters = $adEntity->getAdditionalParameters();
        $this->deposit = $adEntity->getDeposit();
        $this->user_id = $adEntity->getUserId();

        $this->save();

        foreach ($adEntity->getImages() as $image) {
            $adImages = new AdImages();
            $adImages->create($image, $this->id);
        }




        $images = AdImages::where('ads_id', $this->id)->get(['id', 'img_name_hash']);
        $this->region = Region::find($this->region_id);
        $this->rents = $this->rents();

        $this->images = $images;
        $elastic = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();

        $elastic->index([
            'index' => 'ad',
            'type' => 'ad',
            'id' => $this->id,
            'body' => $this->toArray()
        ]);
    }


    public static function getAdWithContext($id)
    {
        $ad = Ad::with('images')
            ->with('region')
            ->with('category')
            ->with('rents:date_rent_from,date_rent_to,ad_id')
            ->findOrFail($id);
        $similar = Ad::where('category_id', $ad->category_id)
            ->where('id', '!=', $ad->id)
            ->with('images')
            ->take(10)
            ->get();
        $ad->similar = $similar;

        return $ad;
    }

    public static function filterCategory(array $filters)
    {
        $query['bool']= ['filter' => []];
        if( isset($filters["category"]) && $filters["category"] !== "") {
            $category = Category::where('category_name', $filters["category"])->first();

            $term['term'] = [
                'category_id' => $category->id
            ];
            $query['bool']['filter'][]=$term;
        }

        if(isset($filters['city'])){
            $city['term']=[
                'region.id'=>$filters['city']
            ];
            $query['bool']['filter'][] = $city;
        }

        if(isset($filters['keyphrase'])){
            $query['bool']['must']= [
                'multi_match'=>[
                    'query' => $filters['keyphrase'],
                    'fuzziness' => 'AUTO',
                    'fields' => ['item_title^3', 'description'],
                ]
            ];
        }
        if(isset($filters['price_from']) || isset($filters["price_to"])){
            $range['range'] = [
                'one_day_price' => []
            ];
            $range_array = [];
            if(isset($filters["price_from"])){
                $range_array["gte"] = $filters["price_from"];
            }
            if(isset($filters["price_to"])){
                $range_array["lte"] = $filters["price_to"];
            }
            $range['range']['one_day_price'] = $range_array;
            $query['bool']['must'][] = $range;
        }

//        if(isset($filters["date_from"]) && isset($filters["date_to"])){
//            $range_from_less = [
//                "range"=>[
//                    "rents.date_rent_from" => [
//                        "lte"=> $filters['date_from'],
//                        "format"=>"yyyy-MM-dd"
//                    ],
//                ]
//            ];
//
//            $range_to_less= [
//                "range"=>[
//                    "rents.date_rent_to" => [
//                        "lte"=> $filters['date_to'],
//                        "format"=>"yyyy-MM-dd"
//                    ]
//                ]
//            ];
//
//            $range_from_greater = [
//                "range"=>[
//                    "rents.date_rent_from" => [
//                        "gte"=> $filters['date_from'],
//                        "format"=>"yyyy-MM-dd"
//                    ],
//                ]
//            ];
//
//            $range_to_greater= [
//                "range"=>[
//                    "rents.date_rent_to" => [
//                        "gte"=> $filters['date_to'],
//                        "format"=>"yyyy-MM-dd"
//                    ]
//                ]
//            ];
//            $must1 = [$range_from_less, $range_to_less];
//            $must2 = [$range_from_greater, $range_to_greater];
//            $query['bool']['should']['bool'][]['must'][]= $must1;
//            $query['bool']['should']['bool'][]['must'][]= $must2;
//            //$query['bool']['should']['bool']['must'][]= $range_to;
//        }
        if($query == []){
            $query['bool'] = ["match_all"=>[]];
        }

        if( isset($filters["date_from"]) && isset($filters["date_to"]) ) {
            $size = 1000;
        }else{
            $size = $filters['size'];
        }

        $parameters = [
            'from'=>$filters["from"],
            'size'=>$size,
            'index' => 'ad',
            'type' => 'ad',
            'allow_partial_search_results' => true,
            'body' => [
                'query' => [
                    'bool'=>$query['bool'],
                ]
            ]
        ];

        $elastic = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();

        $result = $elastic->search($parameters);
        $response = [
            "items"=>[],
            "total"=> ""
        ];
        $c= 0;
        foreach ($result['hits']['hits'] as $res) {
            if( isset($filters["date_from"]) && isset($filters["date_to"]) ){
                try{
                    Rent::validateUniqueReservation($res['_source']["id"],$filters["date_from"], $filters["date_to"]);
                    array_push($response["items"], $res['_source']);
                    $c++;
                }catch (DatesReservedException $exception){
                }
                if($c>=$filters['size'])
                    break;
            }else{
                array_push($response["items"], $res['_source']);
                $response["total"] = $result["hits"]["total"]["value"];
            }
        }

        return $response;
    }


    public function images()
    {
        return $this->hasMany("App\Http\DAL\Models\AdImages", 'ads_id');
    }

    public function region()
    {
        return $this->belongsTo("App\Http\DAL\Models\Region", 'region_id');
    }

    public function category()
    {
        return $this->belongsTo("App\Http\DAL\Models\Category", 'category_id');
    }

    public function all_rents()
    {
        return $this->hasMany("App\Http\DAL\Models\Rent", 'ad_id');

    }

    public function rents()
    {
        return $this->hasMany("App\Http\DAL\Models\Rent", 'ad_id')
            ->where('status_id', '!=', 3);
    }

}
