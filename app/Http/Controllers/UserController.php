<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->userRepository->getAll();
        return UserResource::collection($users);
    }

    public function store(CreateUserRequest $request): array
    {
        $response = $this->userService->createUser($request->validated());
        return $response;
    }

    public function show(int $id)
    {
        $user = $this->userService->userRepository->getOne($id);
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request)
    {
        $this->userService->updateUser($request->validated());
        return response()->json(['message' => __('apiResponseMessage.user.update')]);
    }

    public function destroy(string $id)
    {
        $this->userService->userRepository->deleteUser($id);
        return response()->json(['message' => __('apiResponseMessage.user.delete')]);
    }
}
