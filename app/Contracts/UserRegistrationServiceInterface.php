<?php

namespace App\Contracts;

interface UserRegistrationServiceInterface
{
    public function registerUser(array $userData);
}
