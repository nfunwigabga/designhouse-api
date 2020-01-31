<?php
namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\Contracts\IUser;

class UserRepository extends BaseRepository implements IUser
{
    
    public function model()
    {
        return User::class; 
    }

    public function findByEmail($email)
    {
        return $this->model
                    ->where('email', $email)
                    ->first();
    }
}