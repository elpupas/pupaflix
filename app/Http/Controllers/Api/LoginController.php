<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Dotenv\Exception\ValidationException;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {

        $this->loginService = $loginService;

    }

    public function login(LoginRequest $request)
    {
        try {
            $userData = $request;
            $user = $this->loginService->attempLogin($userData);

            if (isset($user['token'])) {

                return response()->json(['message' => 'Usuario loguedo ', 'name' => $user['name'], 'user_id' => $user['user_id'], 'token' => $user['token']], 200);

            }

        } catch (ValidationException $login) {

            return response()->json(['error' => $login->getMessage()], $login->getCode());

        }

    }

    public function logout()
    {
        try {
            $this->loginService->invalidateSessionToken();

            return response()->json(['message' => 'Usuario loueado'], 200);

        } catch (ValidationException) {

        }

    }
}
