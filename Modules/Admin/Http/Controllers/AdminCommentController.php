<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminCommentController extends Controller
{

    public function index()
    {
        return view('admin::comments.index');
    }

    public function data(Request $request)
    {
        return response()->json(Comment::generateDataTable($request));
    }

    public function activate(Comment $comment)
    {
        $comment->approved = $comment->isApproved() == 0 ? 1 : 0;
        $comment->save();
        return redirect(route('comments.index'));
    }

}
