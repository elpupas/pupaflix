<?php

namespace App\Services;

use App\Contracts\UserRegistrationServiceInterface;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;





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
        $user = $this->userRepository->create($userData);

       
               return $user;
    }
}
