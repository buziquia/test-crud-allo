<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $users = User::factory()->count(5)->create();

        $response = $this->get('/api/usertest');

        $response->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJson($users->toArray());
    }

    public function testStore()
    {
        $user = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret',
        ];

        $response = $this->postJson('/api/usertest', $user);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->assertTrue(Hash::check('secret', User::first()->password));
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $response = $this->get('/api/usertest/' . $user->id);

        $response->assertStatus(200)
            ->assertJson($user->toArray());
    }

    public function testUpdate()
    {
        $user = User::factory()->create(['name' => 'Tarefa']);

        $response = $this->putJson('/api/usertest/' . $user->id, [
            'name' => 'teste',
            'email' => 'teste@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'user' => [
                    'name' => 'teste',
                    'email' => 'teste@example.com',
                ],
                'message' => 'User updated successfully',
            ]);

        $updatedUser = User::find($user->id);

        $this->assertEquals('teste', $updatedUser->name);
        $this->assertEquals('teste@example.com', $updatedUser->email);
        $this->assertTrue(Hash::check('12345678', $updatedUser->password));
    }


    public function testDestroy()
    {
        $user = User::factory()->create();

        $response = $this->delete('/api/usertest/' . $user->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Usuário apagada.',
            ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
