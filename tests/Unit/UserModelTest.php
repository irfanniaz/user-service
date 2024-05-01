<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{

    use RefreshDatabase; 
    /**
     * A basic unit test example.
     */
    public function test_user_creation(): void
    {
        $userData = [
            'email' => 'test@example.com',
            'name' => 'John',
            'password' => 'test12345',
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertEquals($userData['name'], $user->firstName);
        $this->assertEquals($userData['password'], $user->lastName);
    
    }
}
