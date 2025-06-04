<?php


namespace Tests\Unit;

use App\Http\Logic\Entity\UserEntity;
use App\Http\Logic\Exceptions\User\InvalidEmailException;
use App\Http\Logic\Exceptions\User\InvalidPasswordFormatException;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testCreateUserEmailException(){

        $email2 = "testemail.com";
        $password1="12345678";
        $this->expectException(InvalidEmailException::class);
        $userEntity = new UserEntity($email2,$password1);

    }

    public function testCreateUserPasswordException(){
        $email1 = "test@email.com";
        $password2="12345";
        $this->expectException(InvalidPasswordFormatException::class);
        $userEntity = new UserEntity($email1,$password2);
    }

    public function testCreateUserOk(){
        $email1 = "test@email.com";
        $password1="12345678";
        $user = new UserEntity($email1,$password1);
        $this->assertTrue(true);
    }

}
