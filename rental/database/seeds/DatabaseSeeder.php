<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'id'=>'1',
            'email'=>'test@email.com',
            'password'=>'12345678',
            'name'=>'Vladyslav',
            'second_name'=>'Nuzhnyi',
            'address'=>'Pavlova 9',
            'city'=>'Kropyvnytskyi',
        ]);

        factory(\App\Http\DAL\Models\User::class, 50)->create();


        DB::table('regions')->insert([
            'region_name' => "Kyiv",
        ]);
        DB::table('regions')->insert([
            'region_name' => "Kropyvnytskyi",
        ]);


        DB::table('category')->insert([
            'category_name'=>'Cars'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Apartments'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Clothes'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Equipment'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Tourism'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Sport'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Furniture'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Electronics'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Home appliances'
        ]);
        DB::table('category')->insert([
            'category_name'=>'Party equipment'
        ]);


        DB::table('rent_statuses')->insert([
            'id' => '1',
            'status_text'=>'Reserved'
        ]);
        DB::table('rent_statuses')->insert([
            'id' => '2',
            'status_text'=>'Approved'
        ]);
        DB::table('rent_statuses')->insert([
            'id' => '3',
            'status_text'=>'Archived'
        ]);
        factory(\App\Http\DAL\Models\Ad::class, 150)->states('instruments')->create()
            ->each(function ($ad){
                DB::table('ads_images')->insert([
                    "img_name_hash"=>'instruments/'.rand(1,3).'.jpg',
                    "ads_id"=>$ad->id,
                ]);
                DB::table('ads_images')->insert([
                    "img_name_hash"=>'instruments/'.rand(1,3).'.jpg',
                    "ads_id"=>$ad->id,
                ]);

                DB::table("rents")->insertOrIgnore([
                    "item_owner_id" => $ad->user_id,
                    "item_renter_id" => rand(1,49),
                    "ad_id"=>$ad->id,
                    "status_id" => 2,
                    "date_rent_from" => (new DateTime())->setTimestamp(time()+rand(0,55555)),
                    "date_rent_to" =>  (new DateTime())->setTimestamp(time()+rand(0,10000000)),
                    "one_day_price" => $ad->one_day_price,
                    "invoice_nr" => Str::random(8),
                    "rent_item_title" => $ad->item_title
                ]);

        });

        factory(\App\Http\DAL\Models\Ad::class, 150)->states('sport')->create()
            ->each(function ($ad) {
                DB::table('ads_images')->insert([
                    "img_name_hash"=>'bicycle/'.rand(1,4).'.jpg',
                    "ads_id"=>$ad->id,
                ]);
                DB::table('ads_images')->insert([
                    "img_name_hash"=>'bicycle/'.rand(1,4).'.jpg',
                    "ads_id"=>$ad->id,
                ]);
        });




    }

    private function hashPassword($password){
        $secret_part = env("SECRETE_PASSWORD_HASH");
        return hash("sha256",$secret_part.$password);
    }
}
