<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskMail;

class TaskManager extends Model
{
    protected $table = 'tasks'; // Add this if your table name is "tasks"

    protected $fillable = [
        'task_name',
        'task_owner_email',
        'task_owner',
        'task_description',
        'status',
        'task_eta',
    ];

    protected static function booted()
    {
        static::created(function ($task) {
            logger('Sending task email to: ' . $task->task_owner_email);
            if (!empty($task->task_owner_email)) {
                Mail::to($task->task_owner_email)->send(new TaskMail($task));
            }
        });
    }
}
