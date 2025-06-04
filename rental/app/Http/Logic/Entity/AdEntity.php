<?php


namespace App\Http\Logic\Entity;


use App\Http\Logic\Exceptions\Deposit\MinDayCountException;
use App\Http\Logic\Exceptions\Deposit\MinDepositAmountException;
use App\Http\Logic\Exceptions\Deposit\TitleNotPass;

class AdEntity
{
    private $id;
    private $images;
    private $title;
    private $min_day_count;
    private $daily_price;
    private $allow_sending_to_other_city;
    private $deposit;
    private $category;
    private $address;
    private $region;
    private $description;
    private $additional_parameters;
    private $user_id;


    /**
     * AdEntity constructor.
     * @throws TitleNotPass
     * @throws MinDayCountException
     * @throws MinDepositAmountException
     */
    public function __construct(
        array $images,
        string $title,
        int $min_day_count,
        float $daily_price,
        bool $allow_sending_to_other_city,
        int $category,
        string $address,
        string $description,
        int $region,
        int $user_id,
        array $additional_parameters=null,
        float $deposit=null
    )
    {

        $this->setImages($images);
        $this->setTitle($title);
        $this->setMinDayCount($min_day_count);
        $this->setDailyPrice($daily_price);;
        $this->setDeposit($deposit);
        $this->setCategory($category);
        $this->setAddress($address);
        $this->setAdditionalParameters($additional_parameters);

        $this->user_id = $user_id;
        $this->region = $region;
        $this->allow_sending_to_other_city = $allow_sending_to_other_city;
        $this->description = $description;
    }

    /**
     * @throws TitleNotPass
     */
    public function setTitle(string $title): void
    {
        if(strlen($title) < 3){
            throw new TitleNotPass();
        }
        $this->title = $title;
    }

    /**
     * @throws MinDayCountException
     */
    public function setMinDayCount(int $min_day_count): void
    {
        if($min_day_count < 1)
            throw new MinDayCountException();
        $this->min_day_count = $min_day_count;
    }

    /**
     * @throws MinDepositAmountException
     */
    public function setDeposit(?float $deposit): void
    {
        if($deposit===null)
            return;
        if($deposit <= 1 )
            throw new MinDepositAmountException();
        $this->deposit = $deposit;
    }

    public function setAdditionalParameters($additional_parameters): void
    {
        $this->additional_parameters = $additional_parameters;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }


    public function getImages(): array
    {
        return $this->images;
    }


    public function setImages(array $images): void
    {
        $this->images = $images;
    }


    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }



    public function getMinDayCount(): int
    {
        return $this->min_day_count;
    }




    public function getDailyPrice(): float
    {
        return $this->daily_price;
    }


    public function setDailyPrice(float $daily_price): void
    {
        $this->daily_price = $daily_price;
    }


    public function isAllowSendingToOtherCity(): bool
    {
        return $this->allow_sending_to_other_city;
    }


    public function getDeposit(): ?float
    {
        return $this->deposit;
    }


    public function getCategory(): int
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getAdditionalParameters(): ?array
    {
        return $this->additional_parameters;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }



}
