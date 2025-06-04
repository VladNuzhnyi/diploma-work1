<?php


namespace Tests\Unit;


use App\Http\Logic\Entity\AdEntity;
use App\Http\Logic\Exceptions\Deposit\MinDayCountException;
use App\Http\Logic\Exceptions\Deposit\MinDepositAmountException;
use App\Http\Logic\Exceptions\Deposit\TitleNotPass;
use Tests\TestCase;

class AdTest extends TestCase
{

    public function testAdCreationSuccess(){

        $images = ['aaaa','bbbb'];
        $title = "AAAA";
        $min_day_count=1;
        $daily_price=20;
        $allow_sending_to_other_city=false;
        $category='ski';
        $address='Sadova 50';
        $description="My description";
        $region="Kyiv";

        $ad = new AdEntity(
             $images,
             $title,
             $min_day_count,
             $daily_price,
             $allow_sending_to_other_city,
             $category,
             $address,
             $description,
             $region,
            1
        );
        $this->assertTrue(true);
    }

    public function testAdCreationTitleTooShortError(){

        $images = ['aaaa','bbbb'];
        $title = "AA";
        $min_day_count=1;
        $daily_price=20;
        $allow_sending_to_other_city=false;
        $category='ski';
        $address='Sadova 50';
        $description="My description";
        $region="Kyiv";

        $this->expectException(TitleNotPass::class);
        $ad = new AdEntity(
            $images,
            $title,
            $min_day_count,
            $daily_price,
            $allow_sending_to_other_city,
            $category,
            $address,
            $description,
            $region,
            1
        );

    }
    public function testAdCreationMinDayCountError(){

        $images = ['aaaa','bbbb'];
        $title = "AAA";
        $min_day_count=0;
        $daily_price=20;
        $allow_sending_to_other_city=false;
        $category='ski';
        $address='Sadova 50';
        $description="My description";
        $region="Kyiv";

        $this->expectException(MinDayCountException::class);
        $ad = new AdEntity(
            $images,
            $title,
            $min_day_count,
            $daily_price,
            $allow_sending_to_other_city,
            $category,
            $address,
            $description,
            $region,
            1
        );

    }
    public function testAdCreationMinDepositAmountError(){

        $images = ['aaaa','bbbb'];
        $title = "AAA";
        $min_day_count=2;
        $daily_price=20;
        $allow_sending_to_other_city=false;
        $category='ski';
        $address='Sadova 50';
        $description="My description";
        $region="Kyiv";
        $deposit = 0.0;

        $this->expectException(MinDepositAmountException::class);
        $ad = new AdEntity(
            $images,
            $title,
            $min_day_count,
            $daily_price,
            $allow_sending_to_other_city,
            $category,
            $address,
            $description,
            $region,
            1,
            null,
            $deposit
        );
        $this->assertTrue(true);

    }

}
