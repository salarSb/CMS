<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\StorePostRequest;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin::posts.index');
    }

    public function create()
    {
        return view('admin::posts.create');
    }

    public function store(StorePostRequest $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin::posts.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
