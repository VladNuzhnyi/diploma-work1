<?php


namespace App\Http\Logic\Services;


use App\Http\DAL\Models\User;
use App\Http\Logic\Entity\UserEntity;
use App\Http\Logic\Exceptions\User\AccessDeniedException;
use App\Http\Logic\Exceptions\User\InvalidEmailException;
use App\Http\Logic\Exceptions\User\InvalidPasswordFormatException;
use App\Http\Logic\ServiceInterfaces\UserServiceInterface;
use App\Http\Logic\Validators\CreateUserValidator;
use App\Http\Logic\Validators\LoginUserValidator;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{

    /**
     * @param array $fields
     * @throws \App\Http\Logic\Exceptions\User\InvalidEmailException
     * @throws \App\Http\Logic\Exceptions\User\InvalidPasswordFormatException
     * @throws \App\Http\Logic\Exceptions\User\UserWithEmailExists
     * @throws \App\Http\Logic\Exceptions\ValidationException
     */
    public function createUser(array $fields): void
    {
        $validator = new CreateUserValidator($fields);
        $validator->validate();
        $user = new UserEntity(
            $fields["email"],
            $fields["password"]
        );
        $user->setName($fields["name"]);
        $user->setSecondName($fields["second_name"]);
        (new User())->create($user);
    }

    /**
     * @param array $fields
     * @return array
     * @throws \App\Http\Logic\Exceptions\User\InvalidPasswordException
     * @throws \App\Http\Logic\Exceptions\User\NoUserWithSuchEmail
     * @throws \App\Http\Logic\Exceptions\ValidationException
     */
    public function login(array $fields): array
    {
        $validator = new LoginUserValidator($fields);
        $validator->validate();
        try{
            $user = new UserEntity(
                $fields["email"],
                $fields["password"]
            );
        }catch (InvalidPasswordFormatException $exception){
        }catch (InvalidEmailException $exception){
        }

        $response = (new User())->login($user);
        setcookie("jwt",$response['jwt'], time() + 60*60*2,'/');
        return $response;
    }

    /**
     * @param int $loggedInId
     * @param User $user
     * @return Model
     * @throws AccessDeniedException
     */
    public function getInfo(int $loggedInId, User $user): Model
    {
        if($loggedInId !== $user->id)
            throw new AccessDeniedException();
        return $user->getSecure();
    }
}
