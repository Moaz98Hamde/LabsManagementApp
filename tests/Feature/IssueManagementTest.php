<?php

namespace Tests\Feature;

use App\Device;
use App\Issue;
use App\Lab;
use Tests\AuthenticatedTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IssueManagementTest extends AuthenticatedTestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_the_issue_list_for_a_device()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);
        $issue = factory(Issue::class)->create(['device_id' => $device->id]);

        $response = $this->get("/lab/{$lab->id}/device/{$device->id}");

        $response->assertStatus(200);
        $response->assertSee($issue->title);
    }

    /** @test */
    public function an_issue_can_be_created_for_a_device()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);
        $this->get("/device/{$device->id}/issue/create")->assertStatus(200);

        $response = $this->post("/device/{$device->id}/issue", [
            'title' => 'Test Issue',
            'description' => 'Test Description',
        ]);

        $response->assertRedirect("/lab/{$lab->id}/device/{$device->id}");
        $this->assertDatabaseHas('issues', ['title' => 'Test Issue']);
    }

    /** @test */
    public function an_issue_can_be_resolved()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);
        $issue = factory(Issue::class)->create(['device_id' => $device->id, 'resolved' => false]);

        $response = $this->get("/issue/{$issue->id}/resolve");

        $response->assertRedirect();
        $this->assertDatabaseHas('issues', ['id' => $issue->id, 'resolved' => true]);
    }

    /** @test */
    public function an_issue_can_be_retreated()
    {
        $lab = factory(Lab::class)->create();
        $device = factory(Device::class)->create(['lab_id' => $lab->id]);
        $issue = factory(Issue::class)->create(['device_id' => $device->id, 'resolved' => true]);

        $response = $this->get("/issue/{$issue->id}/retreat");

        $response->assertRedirect();
        $this->assertDatabaseHas('issues', ['id' => $issue->id, 'resolved' => false]);
    }
}
