<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->get('id');
        return [
            'id' => ['required', 'numeric', 'exists:users,id'],
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'password' => ['required', 'string'],
        ];
    }
}
