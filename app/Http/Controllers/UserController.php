<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index(): JsonResource
    {
        $users = app(UserService::class)->userRepository->getAll();
        return UserResource::collection($users);
    }

    public function store(CreateUserRequest $request): array
    {
        $response = app(UserService::class)->createUser($request->validated());
        return $response;
    }

    public function show(int $id): JsonResource
    {
        $user = app(UserService::class)->userRepository->getOne($id);
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        app(UserService::class)->updateUser($request->validated());
        return response()->json(['message' => __('apiResponseMessage.user.update')]);
    }

    public function destroy(string $id): JsonResponse
    {
        app(UserService::class)->userRepository->deleteUser($id);
        return response()->json(['message' => __('apiResponseMessage.user.delete')]);
    }
}
