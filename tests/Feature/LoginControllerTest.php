<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function test_Login_Success()
    {
        $user = User::factory()->create([
            'email' => 'pruebalogin@test.com',
            'password' => bcrypt('password123'),
        ]);

        $requestData = [
            'email' => 'pruebalogin@test.com',
            'password' => 'password123',
        ];

        $response = $this->json('POST', '/api/v1/login', $requestData);

        $response->assertStatus(200)->assertJsonStructure(['token']);
        $response->assertHeader('Content-Type', 'application/json');

    }

    public function test_a_user_can_login_with_short_password()
    {
        $user = User::factory()->create([
            'email' => 'peter2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $credentials = [
            'email' => 'peter2@gmail.com',
            'password' => '1234567',
        ];

        $response = $this->json('POST', '/api/v1/login', $credentials);
        $response->assertJson([
            'errors' => [
                'password' => [
                    'The password field must be at least 8 characters.',
                ],
            ],
        ]);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(422);

    }

    public function test_a_user_can_login_with_bad_mail()
    {
        $user = User::factory()->create([
            'email' => 'peter2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $credentials = [
            'email' => 'petergmail.com',
            'password' => '12345678',
        ];

        $response = $this->postJson(route('login'), $credentials);
        $response->assertJson([
            'errors' => [
                'email' => [
                    'The email field must be a valid email address.',
                ],
            ],
        ]);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(422);

    }

    public function test_a_user_can_login_with_bad_credentials()
    {
        $user = User::factory()->create([
            'email' => 'peter2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $credentials = [
            'email' => 'peter2@gmail.com',
            'password' => '123456798',
        ];
        $response = $this->json('POST', '/api/v1/login', $credentials);
        $response->assertJson([
            'error' => 'Credenciales invalidas',
        ]);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(401);

    }

    public function test_can_logout()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $user = $this->postJson('/api/v1/logout');
        $user->assertJson(['message' => 'Usuario loueado']);
        $user->assertStatus(200);

        /*  $this->assertNull($user->fresh()->token());  */

    }

    public function test_logout_no_auth()
    {

        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/logout');

        $response->assertStatus(401);

        $response->assertJson(['error' => __('Usuario no autenticado.')]);

        $this->assertNull($response->headers->get('Authorization'));
    }
}
