<?php

namespace App\Contracts\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $userData);

    public function updateUserData($request, User $user);

    public function removeUser($id);
}
