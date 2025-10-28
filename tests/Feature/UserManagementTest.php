<?php

namespace Tests\Feature;

use App\User;
use Tests\AuthenticatedTestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class UserManagementTest extends AuthenticatedTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_the_user_list()
    {
        $response = $this->get('/user');

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
    }

    /** @test */
    public function a_user_can_be_created()
    {
        $this->get('/user/create')->assertStatus(200);

        $response = $this->post('/user', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/user');
        $this->assertDatabaseHas('users', ['name' => 'Test User']);
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $userToUpdate = factory(User::class)->create();
        $this->get("/user/{$userToUpdate->id}/edit")->assertStatus(200);

        $response = $this->put("/user/{$userToUpdate->id}", [
            'name' => 'Updated Name',
            'email' => $userToUpdate->email,
        ]);

        $response->assertRedirect('/user');
        $this->assertDatabaseHas('users', ['id' => $userToUpdate->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $userToDelete = factory(User::class)->create();

        $response = $this->delete("/user/{$userToDelete->id}");

        $response->assertRedirect('/user');
        $this->assertDatabaseMissing('users', ['id' => $userToDelete->id]);
    }

    /** @test */
    public function name_is_required_to_create_a_user()
    {
        $response = $this->post('/user', [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('name');
    }
}
