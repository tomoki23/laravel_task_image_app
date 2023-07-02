<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request)
    {
        Comment::create([
            'user_id' => $request->user()->id,
            'task_id' => $request->id,
            'body' => $request->comment
        ]);

        return to_route('tasks.show', ['id' => $request->id]);
    }
}
