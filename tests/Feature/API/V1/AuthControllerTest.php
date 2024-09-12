<?php

namespace Tests\Feature\API\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;

    /**
     * Test the login endpoint with valid credentials.
     *
     * @return void
     */
    public function test_login_with_valid_credentials()
    {
        // Create a user for testing
        $user = User::factory()->create([
            'password' => bcrypt($password = 'Moon@123456') // Ensure the password matches
        ]);

        // Define the login credentials
        $credentials = [
            'email' => $user->email,
            'password' => $password
        ];

        // Send a POST request to the login endpoint
        $response = $this->postJson('/api/auth/login', $credentials);

        // Assert the response status is 200 OK
        $response->assertStatus(200);

        // Assert the response contains a token and expiration time
        $response->assertJsonStructure([
            'token',
            'expires_in',
            'token_type'
        ]);

        // Optionally, check if the token is valid
        $this->assertNotNull($response->json('token'));
    }
}
