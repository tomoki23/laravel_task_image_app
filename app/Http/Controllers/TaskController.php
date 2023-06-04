<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $userId = $request->input('user_id');
        $categoryId = $request->input('category_id');
        $title = $request->input('title');
        $body = $request->input('body');
        $imagePath = '';
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
        }
        $firstStatusCode = 3;

        Task::create([
            'user_id' => $userId,
            'category_id' => $categoryId,
            'title' => $title,
            'image_path' => $imagePath ? $imagePath : '',
            'body' => $body,
            'status' => $firstStatusCode,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return to_route('tasks.index');
    }
}
