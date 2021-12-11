<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Modules\Admin\Traits\AdminUtil;

class AdminCategoryController extends Controller
{
    use AdminUtil;

    public function index()
    {
        return view('admin::categories.index');
    }

    public function data(Request $request)
    {
        return response()->json(Category::generateDataTable($request));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin::categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['slug'] ?? $inputs['slug'] = $this->createSlug($inputs['name']);
        Category::create($inputs);
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin::categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $inputs = $request->all();
        $inputs['slug'] ?? $inputs['slug'] = $this->createSlug($inputs['name']);
        $category->update($inputs);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        //
    }
}
