<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogAuthSampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        $response = $this->post('/api/register', [
            'name' => 'quera',
            'family' => 'quera',
            'mobile' => '123456789',
            'password' => '123456789'
        ]);

        $this->assertDatabaseHas('users', [
            'mobile' => '123456789'
        ]);

        $response->assertStatus(200);
    }
}
