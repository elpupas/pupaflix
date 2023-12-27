<?php

namespace App\Contracts\User;

use Illuminate\Http\Request;

interface UserProfileService
{
    public function getUserById($id): array;

    public function updateUserDetails(Request $request, $id);

    public function deleteUser($id);
}
