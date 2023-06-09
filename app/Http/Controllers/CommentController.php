<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\DeleteCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

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

    public function destroy($commentId, DeleteCommentRequest $request)
    {
        $taskId = $request->input('task_id');
        Comment::destroy($commentId);

        return to_route('tasks.show', ['id' => $taskId]);
    }
}
