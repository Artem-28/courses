<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function create($data): User
    {
        $user = new User([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_verified_at' =>$data['email_verified_at'],
        ]);
        $user->save();

        return $user;
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function getUserByIds(...$ids): Collection
    {
        return User::find($ids);
    }

}
