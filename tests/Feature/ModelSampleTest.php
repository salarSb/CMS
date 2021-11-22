<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ModelSampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_table()
    {
        $this->assertTrue(Schema::hasColumns('posts', ['user_id', 'title', 'slug', 'description', 'body', 'images', 'view', 'approved']));
    }

    public function test_users_table()
    {
        $this->assertTrue(Schema::hasColumns('users', ['level', 'name', 'family', 'email', 'mobile', 'password']));
    }
}
