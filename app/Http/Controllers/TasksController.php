<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        return view('welcome')->withTasks(Task::incomplete()->get());
    }

    public function show(Task $task) // Route:model binding
    {
        return $task;
    }
}
