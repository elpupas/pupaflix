<?php

namespace App\Services\User;

use App\Contracts\User\UserProfileService;
use App\Contracts\User\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\EloquentUserRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService implements UserProfileService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    private function verifyUser($auth, $user)
    {
        if (! $user) {
            throw new HttpResponseException(response()->json(['error' => 'Usuario no encontrado'], 404));
        }
        if ($user->id !== $auth) {
            throw new HttpResponseException(response()->json(['error' => 'Usuario no autorizado'], 401));
        }

    }

    public function getUserById($id): array
    {
        $user = User::find($id);
        $authUser = Auth::user();
        $this->verifyUser($authUser->id, $user);

        $address = $user->adreesses()->first();

        return [
            'userData' => $user,
            'address' => $address,
        ];

    }

    public function updateUserDetails(Request $request, $id)
    {
        $user = User::find($id);
        $authUser = Auth::user();

        $this->verifyUser($authUser->id, $user);

        $userData = $request->all();

        $data = $this->userRepository->updateUserData($userData, $user);
        if (! $data) {
            throw new HttpResponseException(response()->json(['error' => 'Error al actualizar el usuario'], 404));
        }

        return $data;

    }

    public function deleteUser($id)
    {

        $user = User::find($id);
        $authUser = Auth::user();

        $this->verifyUser($authUser->id, $user);
        $delete = $this->userRepository->removeUser($user);

        if (! $delete) {
            throw new HttpResponseException(response()->json(['error' => 'Error al eliminar el usuario'], 500));
        }

        return true;

    }
}
