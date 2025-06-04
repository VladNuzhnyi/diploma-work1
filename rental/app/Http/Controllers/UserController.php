<?php


namespace App\Http\Controllers;


use App\Http\Logic\Exceptions\User\AccessDeniedException;
use App\Http\Logic\Exceptions\User\InvalidEmailException;
use App\Http\Logic\Exceptions\User\InvalidPasswordException;
use App\Http\Logic\Exceptions\User\InvalidPasswordFormatException;
use App\Http\Logic\Exceptions\User\NoUserWithSuchEmail;
use App\Http\Logic\Exceptions\User\UserWithEmailExists;
use App\Http\DAL\Models\User;
use App\Http\Logic\Exceptions\ValidationException;
use App\Http\Logic\ServiceInterfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserServiceInterface $service)
    {
        $this->userService = $service;
    }

    public function createUser(Request $request){

        try{
            $this->userService->createUser($request->all());
        }catch (InvalidPasswordFormatException $exception){
            return response($exception->getMessage(),$exception->getCode());
        }catch (InvalidEmailException $exception){
            return response($exception->getMessage(),$exception->getCode());
        }catch (UserWithEmailExists $exception){
            return response($exception->getMessage(),$exception->getCode());
        }catch (ValidationException $validator){
            return response(["errors" => $validator->errors()],422);
        }

        return response("Created",201);
    }


    public function login(Request $request){

        try{
            $response = $this->userService->login($request->all());
        }catch (NoUserWithSuchEmail $exception){
            return response($exception->getMessage(),$exception->getCode());
        }catch (InvalidPasswordException $exception){
            return response($exception->getMessage(),$exception->getCode());
        }catch (ValidationException $validator){
            return response(["errors" =>$validator->errors()],422);
        }

        return $response;

    }

    public function getInfo(Request $request, User $id){
        try {
            return $this->userService->getInfo($request->user_id,$id);
        }catch (AccessDeniedException $exception){
            return response(["errors" => [$exception->getMessage()]],403);
        }
    }

}
