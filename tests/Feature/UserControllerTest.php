<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function verifyOrCreateRole()
    {
        if (! Role::where('name', 'customer')->exists()) {
            Role::create(['name' => 'customer']);
        }
    }

    public function test_show_user()
    {

        $user = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user->adreesses()->create([
            'country' => 'dirdfreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',

        ]);

        $this->actingAs($user, 'api');
        //Pasas el la variable como id a la ruta
        $response = $this->getJson(route('user.show', ['id' => $user->id]));
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(200);

    }

    public function test_cannot_show_user_another_user()
    {

        $user = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);
        $user2 = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $this->actingAs($user, 'api');
        //Pasas el la variable como id a la ruta
        $response = $this->getJson(route('user.show', ['id' => $user2->id]));
        $response->assertJson([
            'error' => 'Usuario no autorizado']);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertStatus(401);

    }

    public function test_update_specific_user()
    {
        $user = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user->adreesses()->create([
            'country' => 'dirdfreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',

        ]);

        $updateData = [
            'name' => 'Johnc doe',
            'email' => 'jochn@example.com',
            'country' => 'dirreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',
        ];

        $this->actingAs($user, 'api');
        //Pasas el la variable como id a la ruta
        $response = $this->putJson(route('user.update', ['id' => $user->id]), $updateData);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertStatus(200);

        $response->assertJson(['message' => 'Datos actualizados']);

    }

    public function test_cannot_update_another_user()
    {
        $user = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user2 = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user->adreesses()->create([
            'country' => 'dirdfreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',

        ]);

        $updateData = [
            'name' => 'Johnc doe',
            'email' => fake()->email(),
            'country' => 'dirreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',
        ];

        $this->actingAs($user, 'api');
        //Pasas el la variable como id a la ruta
        $response = $this->putJson(route('user.update', ['id' => $user2->id]), $updateData);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertStatus(401);

        $response->assertJson(['error' => 'Usuario no autorizado']);

    }

    public function test_can_delete_specific_user()
    {
        $user = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user->adreesses()->create([
            'country' => 'dirdfreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',

        ]);

        $this->actingAs($user, 'api');
        //Pasas el la variable como id a la ruta
        $response = $this->deleteJson(route('user.delete', ['id' => $user->id]));
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertStatus(200);

        $response->assertJson(['message' => 'Usuario Eliminado']);

    }

    public function test_cannot_delete_another_user()
    {
        $user = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user2 = User::factory()->create([
            'email' => fake()->email(),
            'password' => bcrypt('12345678'),
        ]);

        $user->adreesses()->create([
            'country' => 'dirdfreccion',
            'city' => 'barcelona',
            'street' => '344',
            'zipcode' => '08001',
            'floor' => '34',
            'door' => '2E',

        ]);

        $this->actingAs($user, 'api');
        //Pasas el la variable como id a la ruta
        $response = $this->deleteJson(route('user.delete', ['id' => $user2->id]));
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertStatus(401);

        $response->assertJson(['error' => 'Usuario no autorizado']);

    }
}
