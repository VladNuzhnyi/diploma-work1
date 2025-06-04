<?php


namespace App\Http\Logic\Entity;


use App\Http\Logic\Exceptions\User\InvalidEmailException;
use App\Http\Logic\Exceptions\User\InvalidPasswordFormatException;

class UserEntity
{

    private $email = "";
    private $name = "";
    private $second_name= "";
    private $password = "";
    private $address= "";
    private $city= "";
    private $is_verified= "";
    private $image_base64= "";
    private $jwt_token="";
    private $id="";

    /**
     * @throws InvalidPasswordFormatException
     * @throws  InvalidEmailException
     */
    public function __construct(string $email, string $password)
    {
        $this->validateEmail($email);
        $this->validatePassword($password);

        $this->email = $email;
        $this->password = $this->hashPassword($password);
    }

    private function hashPassword($password){
        $secret_part = env("SECRETE_PASSWORD_HASH");
        return hash("sha256",$secret_part.$password);
    }


    /**
     * @param string $email
     * @throws InvalidEmailException
     */
    private function validateEmail(string $email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }

    /**
     * @return string
     */
    public function getJwtToken(): string
    {
        return $this->jwt_token;
    }

    /**
     * @param string $jwt_token
     */
    public function setJwtToken(string $jwt_token): void
    {
        $this->jwt_token = $jwt_token;
    }


    /**
     * @param string $password
     * @throws InvalidPasswordFormatException
     */
    private function validatePassword(string $password){
        if(strlen($password) < 6)
            throw new InvalidPasswordFormatException();
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->second_name;
    }

    /**
     * @param string $second_name
     */
    public function setSecondName(string $second_name): void
    {
        $this->second_name = $second_name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getIsVerified(): string
    {
        return $this->is_verified;
    }

    /**
     * @param string $is_verified
     */
    public function setIsVerified(string $is_verified): void
    {
        $this->is_verified = $is_verified;
    }

    /**
     * @return string
     */
    public function getImageBase64(): string
    {
        return $this->image_base64;
    }

    /**
     * @param string $image_base64
     */
    public function setImageBase64(string $image_base64): void
    {
        $this->image_base64 = $image_base64;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }


}
