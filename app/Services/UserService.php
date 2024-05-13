<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUser($id)
    {
        return User::where('id', $id)->first();
    }

    public function getLoggedInUser()
    {
        return auth()->user();
    }

    public function getUserByRole($role)
    {
        return User::role($role)->get();
    }


}
