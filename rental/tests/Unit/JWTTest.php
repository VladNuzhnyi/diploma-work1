<?php

namespace Tests\Unit;

use App\Http\Logic\Entity\UserEntity;
use App\Http\Logic\lib\JWTGenerator;
use Tests\TestCase;

class JWTTest extends TestCase
{

    public function testJwt()
    {
        $userEntity = new UserEntity("test@email.com",'12345678');
        $userEntity->setId(1);

        echo "Testing jwt\n\n";

        $jwt = JWTGenerator::generateJwt($userEntity);
        $this->assertNotNull($jwt);

        $response = JWTGenerator::decodeJWT($jwt);
        $this->assertIsArray($response);


        $this->assertTrue(true);
    }

}
