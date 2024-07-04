<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'sanctum')->get('api/users');

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->post('api/users', [
            'name' => 'user',
            'email' => 'user@user.ru',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'user@user.ru']);

        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'sanctum')->get('api/users/' . auth()->user()->id);

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'name'
            ]
        ]);
    }

    public function testUpdate(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'sanctum')->put('api/users/' . auth()->user()->id, [
            'id' => $user->id,
            'name' => 'update_name',
            'email' => 'updateName@updateName.ru',
            'password' => '123456',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'updateName@updateName.ru']);

        $response->assertStatus(200);
    }

    public function testDelete(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'sanctum')->delete('api/users/' . auth()->user()->id);

        $response->assertStatus(200)->assertJson(['message' => 'Пользователь удален.']);
    }
}
