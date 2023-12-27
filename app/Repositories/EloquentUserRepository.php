<?php

namespace App\Repositories;

use App\Contracts\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create($userData)
    {

        try {
            $transaction = DB::transaction(function () use ($userData) {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => bcrypt($userData['password']),
                ]);

                $user->adreesses()->create([
                    'country' => $userData['country'],
                    'city' => $userData['city'],
                    'street' => $userData['street'],
                    'zipcode' => $userData['zipcode'],
                    'floor' => $userData['floor'],
                    'door' => $userData['door'],
                ]);

                $user->assignRole('customer');

                return $user;
            });

            return $transaction;
        } catch (\Throwable $e) {
            // Si ocurre un error, se revierten los cambios y se lanza una excepción
            DB::rollBack();
            throw new \Exception(response()->json(['error' => 'Hubo un error al crear el usuario'], 500));
        }
    }

    public function updateUserData($request, User $user)
    {

        $updatedStudent = DB::transaction(function () use ($request, $user) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save(); 

    
            if ($user->adreesses) {
                $user->adreesses->country = $request['country'];
                $user->adreesses->city = $request['city'];
                $user->adreesses->street = $request['street'];
                $user->adreesses->floor = $request['floor'];
                $user->adreesses->door = $request['door'];
                $user->adreesses->zipcode = $request['zipcode'];
                $user->adreesses->save(); // Guarda los cambios en la dirección
            }if (! $user->adreesses) {
                throw new HttpResponseException(response()->json(['error' => 'Para actualizar la direccion, primero tiene que agregar una'], 400));
            }

            return $user;
        });
        if (! $updatedStudent) {
            throw new HttpResponseException(response()->json(['error' => 'Hubo un error al actualizar'], 500));
        }

        return $updatedStudent;

    }

    public function removeUser($user)
    {
        $user->delete();

        return true;
    }
}
