<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(array $userData)
    {
       
        try {
            $transaction = DB::transaction(function () use ($userData) {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                ]);
    
                return $user;
            });
           
            return $transaction;
        } catch (\Throwable $e) {
            // Si ocurre un error, se revierten los cambios y se lanza una excepción
            DB::rollBack();
            throw new \Exception(response()->json(['error' => 'Hubo un error al crear el usuario'], 500));
        }
    }
}
