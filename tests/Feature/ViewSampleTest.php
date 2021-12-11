<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewSampleTest extends TestCase
{
    public function test_posts_create_page()
    {
        $response = $this->get('/admin/posts/create');
        $response->assertSee('ایجاد پست');
    }

    public function test_posts_edit_page()
    {
        $post = Post::factory()->for(User::factory())->create();
        $response = $this->get('/admin/posts/'. $post->id .'/edit');
        $response->assertSee('ویرایش پست');
    }

    public function test_categories_create_page()
    {
        $response = $this->get('/admin/categories/create');
        $response->assertSee('ایجاد دسته‌بندی');
    }

    public function test_categories_edit_page()
    {
        $cat = Category::factory()->create();
        $response = $this->get('/admin/categories/'. $cat->id .'/edit');
        $response->assertSee('ویرایش دسته‌بندی');
    }
}