<?php


namespace App\Http\Logic\ServiceInterfaces;


use App\Http\DAL\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{

    public function createUser(array $fields):void;
    public function login(array $fields):array;
    public function getInfo(int $loggedInId, User $user):Model;

}
