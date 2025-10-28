<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class AuthenticatedTestCase extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }
}
