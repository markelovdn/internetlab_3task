<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;
    public function testLogin(): void
    {
        $response = $this->post('api/login', [
            'email' => 'test@test.ru',
            'password' => 'test',
        ]);

        $response->assertStatus(200);
    }
}
