<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Traits\AdminUtil;

class AdminPostController extends Controller
{
    use AdminUtil;

    public function index()
    {
        return view('admin::posts.index');
    }

    public function data(Request $request)
    {
        return response()->json(Post::generateDataTable($request));
    }

    public function activate(Post $post)
    {
        $post->approved = $post->isApproved() == 0 ? 1 : 0;
        $post->save();
        return redirect(route('posts.index'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        $tags = Tag::all();
        return view('admin::posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $inputs = $request->except(['categories', 'image']);
        $imagesUrl = $this->uploadImages($request->file('image'), '/images/posts');
        if (!request()->filled('slug')) {
            $inputs['slug'] = $this->createSlug($request->title, '-');
        }
        $post = auth()->user()->posts()->create(
            array_merge($inputs, ['image' => $imagesUrl])
        );
        $post->categories()->sync($request->input('categories'));
        $post->tags()->sync($request->input('tags'));
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = Category::where('parent_id', null)->get();
        $tags = Tag::all();
        return view('admin::posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $inputs = $request->all();
        $inputs['slug'] ?? $inputs['slug'] = $this->createSlug($inputs['title']);
        if ($request->hasFile('image')) {
            Storage::delete($post->image);
            $result = $this->uploadImages($request->file('image'), '/images/posts');
            $inputs['image'] = $result;
        }
        $post->update($inputs);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        //
    }
}
