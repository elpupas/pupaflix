<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\User\UserRegistrationService;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    protected $userRegService;

    public function __construct(UserRegistrationService $userRegService)
    {
        $this->userRegService = $userRegService;

    }

    public function store(RegisterRequest $request)
    {

        try {
            $userData = $request->all();

            // Llamar al servicio para registrar al usuario
            $user = $this->userRegService->registerUser($userData);
            if ($user) {
                return response()->json(['message' => 'Usuario registrado con éxito'], 201);
            }

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
