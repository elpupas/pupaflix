<?php

namespace App\Contracts\User;

interface UserRegistrationServiceInterface
{
    public function registerUser(array $userData);
}
