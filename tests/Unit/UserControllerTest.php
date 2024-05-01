<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_user_creation_endpoint(): void
    {
        $userData = [
            'email' => 'test@example.com',
            'name' => 'John',
            'password' => 'test12345',
        ];

        $response = $this->postJson('/users', $userData);

        $response->assertStatus(201); // Assuming 201 is the status code for successful creation
        $this->assertDatabaseHas('users', $userData);
    }
}
