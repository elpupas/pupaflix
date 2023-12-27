<?php

namespace App\Contracts;

use Illuminate\Support\Facades\Request;

interface LoginServiceInterface
{
    public function attempLogin(Request $userLogin);

    public function invalidateSessionToken();
}
