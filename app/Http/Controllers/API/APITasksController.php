<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\TaskManager;

class APITasksController extends Controller
{
    public function create(Request $request)
    {
        $data = new TaskManager();
        $data->task_name = $request->get('task_name');
        $data->task_description = $request->get('task_description');
        $data->task_owner = $request->get('task_owner');
        $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        
        if($data->save()){
            dispatch(new SendEmailJob($data));
            return "Task Created Successfully";
        }else{
            return "Something went wrong";
        }
    }

    public function index()
    {
        $data = TaskManager::get();
       return $data;
        
    }
    
    public function getTaskByID($id)
    {
        $data = TaskManager::find($id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $data = TaskManager::find($id);
        $data->task_name = $request->get('task_name');
        $data->task_description = $request->get('task_description');
        $data->task_owner = $request->get('task_owner');
        $data->task_owner_email = $request->get('task_owner_email');
        $data->task_eta = $request->get('task_eta');
        if($data->save()){
            return "Got Task using ID and Updated Successfully";
        }else{
            return "Something went wrong";
        }

    }
    public function markAsDone($id)
    {
        $data = TaskManager::find($id);
        if(!$data){
            return "Task not found";
        }
        $data->status=1;
        if($data->save()){
            dispatch(new SendEmailJob($data));
            return "Task Marked As Done Successfully";
        }else{
            return "Something went wrong";
        }

    }
    public function delete($id)
    {
        $data = TaskManager::find($id);
        if(!$data){
            return "Task not found";}
        if($data->delete()){
            return "Task Deleted Successfully";
        }else{
            return "Something went wrong";
        }
    }
    

}
