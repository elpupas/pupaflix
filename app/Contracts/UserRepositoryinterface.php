<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function create(array $userData);
}
