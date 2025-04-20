<?php

namespace App\Http\Controllers;

use App\Models\TaskManager;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Mail\TaskMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
   
    public function create(Request $request)
{
    $task = new TaskManager();

    $task->task_name = $request->task_name;
    $task->task_description = $request->task_description;
    $task->task_owner = $request->task_owner;
    $task->task_owner_email = $request->task_owner_email;
    $task->task_eta = date('Y-m-d', strtotime($request->task_eta));
    $task->save();

    return response()->json(['message' => 'Task created successfully'], 201);
}

}