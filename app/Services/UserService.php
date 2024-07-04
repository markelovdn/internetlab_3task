<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($data)
    {
        $user = $this->userRepository->create($data);
        $token = $user->createToken('api')->plainTextToken;

        return ['user' => new UserResource($user), 'token' => $token];
    }

    public function updateUser($data): User
    {
        return $this->userRepository->update($data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
