<?php

namespace Tests\Feature;

use App\Device;
use App\Issue;
use App\Lab;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_return_all_labs()
    {
        $lab = factory(Lab::class)->create();

        $response = $this->get('/api/labs');

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => $lab->name]);
    }

    /** @test */
    public function it_can_return_all_devices_for_a_lab()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);

        $response = $this->get("/api/labs/{$lab->id}/devices");

        $response->assertStatus(200);
        $response->assertJsonFragment(['description' => $device->description]);
    }

    /** @test */
    public function it_can_return_a_single_device()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);

        $response = $this->get("/api/labs/{$lab->id}/devices/{$device->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['description' => $device->description]);
    }

    /** @test */
    public function it_can_return_all_issues_for_a_device()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);
        $issue = factory(Issue::class)->create(['device_id' => $device->id]);

        $response = $this->get("/api/labs/{$lab->id}/devices/{$device->id}/issues");

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => $issue->title]);
    }

    /** @test */
    public function it_can_create_an_issue_for_a_device()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);

        $response = $this->postJson("/api/labs/{$lab->id}/devices/{$device->id}/issues", [
            'title' => 'Test Issue',
            'description' => 'Test Description',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('issues', ['title' => 'Test Issue']);
    }
}
