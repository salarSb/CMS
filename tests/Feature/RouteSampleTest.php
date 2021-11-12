<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesSampleTest extends TestCase
{
    public function test_admin_panel()
    {
        $response = $this->get('/admin/panel');

        $response->assertStatus(200);
    }
}
