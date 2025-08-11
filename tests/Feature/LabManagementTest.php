<?php

namespace Tests\Feature;

use App\Lab;
use Tests\AuthenticatedTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabManagementTest extends AuthenticatedTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_the_lab_list()
    {
        $lab = factory(Lab::class)->create();

        $response = $this->get('/lab');

        $response->assertStatus(200);
        $response->assertSee($lab->name);
    }

    /** @test */
    public function a_lab_can_be_created()
    {
        $this->get('/lab/create')->assertStatus(200);

        $response = $this->post('/lab', [
            'name' => 'Test Lab',
            'capacity' => 10,
            'supervisor' => 'Test Supervisor',
        ]);

        $response->assertRedirect('/lab');
        $this->assertDatabaseHas('labs', ['name' => 'Test Lab']);
    }

    /** @test */
    public function a_lab_can_be_updated()
    {
        $labToUpdate = factory(Lab::class)->create();
        $this->get("/lab/{$labToUpdate->id}/edit")->assertStatus(200);

        $response = $this->put("/lab/{$labToUpdate->id}", [
            'name' => 'Updated Name',
            'capacity' => 12,
            'supervisor' => 'Updated Supervisor',
        ]);

        $response->assertRedirect('/lab');
        $this->assertDatabaseHas('labs', ['id' => $labToUpdate->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function a_lab_can_be_deleted()
    {
        $labToDelete = factory(Lab::class)->create();

        $response = $this->delete("/lab/{$labToDelete->id}");

        $response->assertRedirect('/lab');
        $this->assertDatabaseMissing('labs', ['id' => $labToDelete->id]);
    }

    /** @test */
    public function a_qr_code_can_be_generated_for_a_lab()
    {
        $lab = factory(Lab::class)->create();

        $response = $this->get("/lab/QR/{$lab->id}");

        $response->assertStatus(200);
        $response->assertViewIs('labs.qrCode');
    }
}
