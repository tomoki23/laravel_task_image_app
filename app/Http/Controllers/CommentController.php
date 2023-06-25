<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create([
            'user_id' => $request->user()->id,
            'task_id' => $request->id,
            'body' => $request->comment
        ]);

        return to_route('tasks.index');
    }
}
