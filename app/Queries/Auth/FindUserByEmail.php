<?php

namespace App\Queries\Auth;

use App\Models\User;

class FindUserByEmail
{
    public function handle(string $email): User
    {
        /** @var User */
        return User::query()
            ->where('email', $email)
            ->firstOrFail();
    }
}
