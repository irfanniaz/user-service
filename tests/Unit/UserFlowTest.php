<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use App\Events\UserCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserFlowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_user_creation_and_notification(): void
    {
        Event::fake();

        $userData = [
            'email' => 'test@example.com',
            'name' => 'John',
            'password' => 'test12345',
        ];

        $response = $this->postJson('/users', $userData);

        $response->assertStatus(201); // Assuming 201 is the status code for successful creation
        $this->assertDatabaseHas('users', $userData);

        Event::assertDispatched(UserCreated::class, function ($event) use ($userData) {
            return $event->user->email === $userData['email'];
        });
    }
}
