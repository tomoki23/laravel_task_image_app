<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $users = User::all();
        $categories = Category::all();
        $tasks = Task::with(['user', 'category'])->get();

        return view('tasks.index', compact('users', 'categories', 'tasks'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('tasks.create', compact('users', 'categories'));
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $assignedUserId = $request->input('assigned_user_id');
        $categoryId = $request->input('category_id');
        $title = $request->input('title');
        $body = $request->input('body');
        $imagePath = null;
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
        }
        $firstStatusCode = 3;

        Task::create([
            'user_id' => $userId,
            'assigned_user_id' => $assignedUserId,
            'category_id' => $categoryId,
            'title' => $title,
            'image_path' => $imagePath,
            'body' => $body,
            'status' => $firstStatusCode,
        ]);

        return to_route('tasks.index');
    }

    public function show($id)
    {
        $task = Task::with(['user', 'assignedUser', 'category'])->findOrFail($id);
        $status = $task->status;

        return view('tasks.show', compact('task', 'status'));
    }

    public function edit($id)
    {
        $task = Task::with(['user', 'assignedUser', 'category'])->find($id);
        $users = User::all();
        $categories = Category::all();

        return view('tasks.edit', compact('task', 'users', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->fill(
            $request->only([
                'assigned_user_id',
                'category_id',
                'title',
                'body',
                'status'
            ])
        );

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
            $task->image_path = $imagePath;
        }
        $task->save();

        return to_route('tasks.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $imagePath = Task::find($id)->image_path;
        if($imagePath){
            Storage::disk('public')->delete($imagePath);
        }
        Task::destroy($id);

        return to_route('tasks.index');
    }
}
