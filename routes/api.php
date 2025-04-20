<?php

use App\Http\Controllers\API\APITasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('task',[APITasksController::class,'create']);
Route::get('task',[APITasksController::class,'index']);
Route::get('task/{id}',[APITasksController::class,'getTaskByID']);
Route::put('task/{id}',[APITasksController::class,'update']);
Route::post('task/done/{id}',[APITasksController::class,'markAsDone']);
Route::delete('task/{id}',[APITasksController::class,'delete']);