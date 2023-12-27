<?php

namespace App\Services;

use App\Contracts\LoginServiceInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class LoginService implements LoginServiceInterface
{
    public function attempLogin($request)
    {

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            throw new HttpResponseException(response()->json(['error' => 'Credenciales invalidas'], 401));
        }

        $user = Auth::user();

        $name = $user->name;
        /** @var \App\Models\User $user * */
        $token = $user->createToken('auth_token')->accessToken;

        return [
            'user_id' => $user->id,
            'token' => $token,
            'name' => $name,
        ];

    }

    public function invalidateSessionToken()
    {

        $user = Auth::user();
        if (! $user) {
            throw new RouteNotFoundException(response()->json(['error' => 'No tienes permisos para acceder a esta ruta']), 403);
        }
        /** @var \App\Models\User $user * */
        $user->token()->delete();

    }
}
