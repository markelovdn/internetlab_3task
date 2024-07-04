<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getAll(): Collection
    {
        return User::get();
    }
    public function getOne($id): ?User
    {
        return User::findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function update($data): User
    {
        $user = $this->getOne($data['id']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->getOne($id);
        $user->delete();
    }
}
