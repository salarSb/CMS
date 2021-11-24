<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthSampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'mobile' => $user->mobile,
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/admin/panel');
    }
}
