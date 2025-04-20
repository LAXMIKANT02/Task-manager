<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'task_owner_email',
        'task_owner',
        'task_description',
        'status',
        'task_eta',
    ];
}
