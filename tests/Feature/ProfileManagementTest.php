<?php

namespace Tests\Feature;

use App\User;
use Tests\AuthenticatedTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileManagementTest extends AuthenticatedTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_their_profile()
    {
        $response = $this->get('/profile');

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
    }

    /** @test */
    public function a_user_can_update_their_profile()
    {
        $response = $this->put('/profile', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'name' => 'Updated Name', 'email' => 'updated@example.com']);
    }
}
