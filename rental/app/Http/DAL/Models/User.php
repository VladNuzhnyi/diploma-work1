<?php


namespace App\Http\DAL\Models;


use App\Http\Logic\Entity\UserEntity;
use App\Http\Logic\Exceptions\User\InvalidPasswordException;
use App\Http\Logic\Exceptions\User\NoUserWithSuchEmail;
use App\Http\Logic\Exceptions\User\UserWithEmailExists;
use App\Http\Logic\lib\JWTGenerator;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * @param UserEntity $entity
     * @throws UserWithEmailExists
     */
    public function create(UserEntity $entity)
    {

        $users = User::where('email', $entity->getEmail())->get();
        if (count($users))
            throw new UserWithEmailExists();

        $this->email = $entity->getEmail();
        $this->password = $entity->getPassword();
        $this->name = $entity->getName();
        $this->second_name = $entity->getSecondName();
        $this->save();
    }

    /**
     * @param UserEntity $entity
     * @return array
     * @throws NoUserWithSuchEmail
     * @throws InvalidPasswordException
     */
    public function login(UserEntity $entity)
    {
        $users = User::where('email', $entity->getEmail())->get();
        if (!count($users))
            throw new NoUserWithSuchEmail();
        $user = $users->first();
        if( $user->password !== $entity->getPassword())
            throw new InvalidPasswordException();
        $entity->setId($user->id);
        $entity->setName($user->name);
        $entity->setSecondName($user->second_name);
        return [
            "jwt"=>JWTGenerator::generateJwt($entity),
            "user_data"=>[
                "id"=>$user->id,
                "first_name"=> $user->name,
                "last_name"=> $user->second_name,
                "email"=>$user->email
            ]
        ];
    }


    public function getSecure(){
        unset($this->password);
        unset($this->jwt_token);
        return $this;
    }

}
