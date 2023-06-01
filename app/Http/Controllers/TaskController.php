<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $users = User::all();
        $categories = Category::all();
        $tasks = Task::with(['user', 'category'])->get();
        $statusLabels = [
            1 => '完了',
            2 => '着手中',
            3 => '未完了'
        ];

        return view('tasks.index', compact('users', 'categories', 'tasks', 'statusLabels'));
    }
}
