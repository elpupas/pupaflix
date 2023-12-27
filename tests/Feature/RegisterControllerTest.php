<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }

    public function verifyOrCreateRole()
    {
        if (! Role::where('name', 'customer')->exists()) {
            Role::create(['name' => 'customer']);
        }
    }

    public function test_create_customer_with_valid_data()
    {
        $this->verifyOrCreateRole();

        $userData = [
            'name' => 'John doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'country' => 'dirreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',
        ];

        $response = $this->post('api/v1/register', $userData);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
        $this->assertDatabaseHas('users', [
            'id' => User::where('email', $userData['email'])->first()->id,
        ]);

        $user = User::where('email', $userData['email'])->first();
        $this->assertTrue($user->hasRole('customer'));

        $response->assertJson([
            'message' => 'Usuario registrado con éxito',
        ]);
        $response->assertStatus(201);
        $response->assertHeader('Content-Type', 'application/json');

    }

    public function test_create_customer_with_invalid_name()
    {
        $this->verifyOrCreateRole();

        $userData = [
            'name' => '',
            'email' => 'johnexample.com',
            'password' => 'password123',
        ];

        $response = $this->post('api/v1/register', $userData);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field must be a string.',
                ],

            ],
        ]);
        $response->assertStatus(422);

    }
}
