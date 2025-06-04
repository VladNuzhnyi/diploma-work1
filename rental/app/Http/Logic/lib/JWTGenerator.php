<?php


namespace App\Http\Logic\lib;

use App\Http\Logic\Entity\UserEntity;
use \Firebase\JWT\JWT;
class JWTGenerator
{


    /**
     * @param UserEntity $user
     * @return string
     */
    public static function generateJwt(UserEntity $user) : string{
        $key = env("SECRETE_JWT_HASH");
        $json = array(
            "id"=>$user->getId(),
            "name"=>$user->getName() . " " . $user->getSecondName(),
            "email"=>$user->getEmail(),
            "timestamp"=>time()
        );
        $jwt = JWT::encode($json, $key);
        return $jwt;
    }

    /**
     * @param $jwt
     * @return array
     */
    public static function decodeJWT($jwt):array {
        $key = env("SECRETE_JWT_HASH");
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        return (array)$decoded;
    }


}
