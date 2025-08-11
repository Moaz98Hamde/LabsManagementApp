<?php

namespace Tests\Feature;

use App\Device;
use App\Lab;
use Tests\AuthenticatedTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceManagementTest extends AuthenticatedTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_the_device_list_for_a_lab()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);

        $response = $this->get("/lab/{$lab->id}");

        $response->assertStatus(200);
        $response->assertSee($device->description);
    }

    /** @test */
    public function a_device_can_be_created_for_a_lab()
    {
        $lab = factory(Lab::class)->create();
        $this->get("/lab/{$lab->id}/device/create")->assertStatus(200);

        $response = $this->post("/lab/{$lab->id}/device", [
            'description' => 'Test Device',
        ]);

        $response->assertRedirect("/lab/{$lab->id}");
        $this->assertDatabaseHas('devices', ['description' => 'Test Device']);
    }

    /** @test */
    public function a_device_can_be_deleted()
    {
        $lab = factory(Lab::class)->create();
        $deviceToDelete = factory(Device::class)->create(['lab_id' => $lab->id]);

        $response = $this->delete("/lab/{$lab->id}/device/{$deviceToDelete->id}");

        $response->assertRedirect("/lab/{$lab->id}");
        $this->assertDatabaseMissing('devices', ['id' => $deviceToDelete->id]);
    }
}
