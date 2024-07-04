<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'auth' => [__('apiResponseMessage.auth.loginFail')],
            ]);
        } else {
            $user = Auth::user();
            $token = $user->createToken('api')->plainTextToken;
            return ['user' => new UserResource($user), 'token' => $token];
        }
    }
}
