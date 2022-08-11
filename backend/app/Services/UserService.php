<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create($data): User
    {
        $user = new User([
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $user->save();

        return $user;
    }
}
