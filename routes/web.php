<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\TaskManager;
use App\Mail\TaskMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Task;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', function () {
    $tasks = TaskManager::all();
    return view('tasks.index', compact('tasks'));
})->name('tasks.index');

Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::get('/test-mail', function () {
    $task = new TaskManager([
        'task_owner' => 'Test User',
        'task_owner_email' => 'your@email.com',
        'task_description' => 'This is a test task',
        'status' => 0,
        'task_eta' => now()->addDays(3)->toDateString(),
    ]);

    Mail::to($task->task_owner_email)->send(new TaskMail($task));

    return 'Test mail sent!';
});