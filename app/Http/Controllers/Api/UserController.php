<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserShowResource;
use App\Services\User\UserService;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);

            return response()->json([new UserShowResource($user)], 200);

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->userService->updateUserDetails($request, $id);

            return response()->json(['message' => 'Datos actualizados', 'Datos' => $user], 200);

        } catch (ValidationException $f) {
            return response()->json(['error' => $f->getMessage()], $f->getCode());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->userService->deleteUser($id);

            return response()->json(['message' => 'Usuario Eliminado'], 200);

        } catch (ValidationException $f) {
            return response()->json(['error' => $f->getMessage()], $f->getCode());

        }
    }
}
