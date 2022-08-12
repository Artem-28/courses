<?php

namespace App\Services;

use App\Models\User;

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
}
