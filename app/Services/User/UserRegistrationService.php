<?php

namespace App\Services\User;

use App\Contracts\User\UserRegistrationServiceInterface;
use App\Contracts\User\UserRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegistrationService implements UserRegistrationServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $userData)
    {
        if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
            throw new HttpResponseException(response()->json(['error' => 'Faltan datos o los campos estan vacios'], 400));
        }
        //El servicio llama al repositorio para registar el usuario
        $user = $this->userRepository->create($userData);
        if (! $user) {
            throw new HttpResponseException(response()->json(['error' => 'Hubo un error con los datos'], 500));
        }

        return $user;
    }
}
