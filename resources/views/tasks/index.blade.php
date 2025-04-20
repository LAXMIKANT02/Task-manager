@extends('layout.baseview')

@section('title', 'Task List')

@section('style')
<style>
    table.table tr.done td,
    table.table tr.done th {
        text-decoration: line-through !important;
        color: grey !important;
    }

    .custom-btn {
        background-color:rgb(228, 222, 183) !important;
        color: #fff;
        border: solid 1px rgb(14, 15, 16);
        border-radius: 15px;
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(46, 49, 22, 0.2) !important;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .custom-btn:hover {
        background-color:rgb(235, 219, 173) !important;
        padding: 8px 22px;
        transition: all 0.3s ease;
        font-size: 18px;
        border: solid 1px rgb(11, 19, 27);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25) !important;
    }

    .modal-header {
        background-color:rgb(228, 222, 183) !important; 
    }

    .modal-body{
        background-color:rgb(249, 247, 220) !important;
        
    }

    .modal-footer {
        background-color: #f7d9c4 !important;
    }

    .btn-primary {
        background-color:rgb(66, 175, 70) !important; 
        border-color:rgb(21, 154, 27) !important;
    }

    
    .btn-primary:hover {
        background-color:rgb(96, 217, 100) !important;
        border-color:rgb(76, 189, 82) !important;
        padding: 8px 15px;
        transition: all 0.3s ease;
        font-size: 18px;
        border: solid 1px rgb(116, 180, 100) !important;
        box-shadow: 0 6px 12px rgba(87, 55, 55, 0.25) !important;
    }

    .btn-secondary {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
    }
    .btn-secondary:hover {
        background-color:rgb(154, 160, 165) !important;
        border-color:rgb(123, 127, 131) !important;
        padding: 8px 15px;
        transition: all 0.3s ease;
        border: solid 1pxrgb(11, 19, 27);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25) !important;
    }

    .card {
        border: 1px solid:rgb(2, 2, 3) !important;
        background-color:rgb(241, 232, 183) !important;
    }

    .table{
        background-color: rgb(239, 239, 198) !important;
        border: 1px solid rgb(224, 174, 109) !important;
    }

    body {
        background-color:rgb(241, 241, 241) !important;
    }

    .bi{
        color: rgb(88, 65, 64) !important;
        cursor: pointer;
        font-size: 17px;
    }

    .bi:hover{
        color: rgb(0, 0, 0) !important;
        font-size: 20px;
        transition: all 0.3s ease;
        transform: scale(1.2);
    }
    
    .navbar{
        background-color: rgb(203, 168, 79) !important;
        border-bottom: 1px solid rgb(70, 70, 64) !important;
    }
    .navbar-brand{
        font-size: 25px !important;
        font-weight: 600 !important;
    }
    .navbar-toggler{
        background-color: rgb(192, 153, 62) !important;
    }

</style>
@endsection


@section('content')
@include('layout.navigation')
<div class="container mt-5">
    <button class="btn custom-btn mb-5" onclick="addTask()">Add Task</button>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sl No.</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Task ETA</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="taskTable"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="taskName">Task Name</label>
                        <input type="text" class="form-control" id="taskName" placeholder="Enter task name">
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Task Description</label>
                        <input type="text" class="form-control" id="taskDescription" placeholder="Enter task Description">
                    </div>
                    <div class="form-group">
                        <label for="taskOwner">Task Owner</label>
                        <input type="text" class="form-control" id="taskOwner" placeholder="Enter task owner">
                    </div>
                    <div class="form-group">
                        <label for="taskOwnerEmail">Task Owner E-mail</label>
                        <input type="text" class="form-control" id="taskOwnerEmail" placeholder="Enter task owner email">
                    </div>
                    <div class="form-group">
                        <label for="taskEta">Task ETA</label>
                        <input type="date" class="form-control" id="taskEta" placeholder="Enter task eta">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="createTask()">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="editTaskName">Task Name</label>
                        <input type="text" class="form-control" id="editTaskName" placeholder="Enter task name">
                    </div>
                    <div class="form-group">
                        <label for="editTaskDescription">Task Description</label>
                        <input type="text" class="form-control" id="editTaskDescription" placeholder="Enter task Description">
                    </div>
                    <div class="form-group">
                        <label for="editTaskOwner">Task Owner</label>
                        <input type="text" class="form-control" id="editTaskOwner" placeholder="Enter task owner">
                    </div>
                    <div class="form-group">
                        <label for="editTaskOwnerEmail">Task Owner E-mail</label>
                        <input type="text" class="form-control" id="editTaskOwnerEmail" placeholder="Enter task owner email">
                    </div>
                    <div class="form-group">
                        <label for="editTaskEta">Task ETA</label>
                        <input type="date" class="form-control" id="editTaskEta" placeholder="Enter task eta">
                    </div>
                    <div class="form-group">
                        <label for="editTaskStatus">Task Status</label>
                        <select class="form-control" id="editTaskStatus">
                            <option>Set Task Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                    <input type="hidden" id="editTaskId" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateTask()">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="markAsDone" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark As Done</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to mark this task as done?</p>
                <input type="hidden" id="markAsDoneId" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateMarkAsDone()">Mark as Done</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteTask" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this task?</p>
                <input type="hidden" id="deleteTaskId" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-focus-safe>Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateTaskDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<footer class="mt-5 py-3 text-center" style="background-color:rgb(221, 164, 102); border-top: 1px solid #ccc;">
    <p class="mb-0" style="color:rgb(71, 45, 45);">
        © {{ date('Y') }} Task Manager App. All rights reserved.
    </p>
</footer>


@endsection

@section('custom_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () {
        getAllTasks();
    });

    
      
    function getAllTasks() {
        $.ajax({
            url: 'http://localhost:8081/api/task',
            type: 'GET',
            success: function (result) {
                console.log("API Response:", result);
                var tasks = Array.isArray(result) ? result : result.data;
              
                var html = '';

                for (var i = 0; i < tasks.length; i++) {
                    var lineThrough = tasks[i].status == 1 || tasks[i].status === '1' ? 'class="done"' : '';
                    console.log("Status for task:", tasks[i].task_name, tasks[i].status);
                    html += '<tr '+lineThrough+'>'
                        + '<td '+lineThrough+'>' + (i + 1) + '</td>'
                        + '<td ' + lineThrough + '>' 
                        +(tasks[i].status == 1 || tasks[i].status === '1' ? '<i class="bi bi-check-circle-fill text-success me-2"></i>' : '') 
                             + tasks[i].task_name  + '</td>'
                        + '<td '+lineThrough+'>' + tasks[i].task_description + '</td>'
                        + '<td '+lineThrough+'>' + tasks[i].task_owner + '</td>'
                        + '<td '+lineThrough+'>' + tasks[i].task_eta + '</td>'
                        + '<td>'
                        + '<i class="bi bi-pencil-square" onclick="editTask(' + tasks[i].id + ')"></i> '
                        + '<i class="bi bi-check-square" onclick="markAsDone(' + tasks[i].id + ')"></i> '
                        + '<i class="bi bi-trash" onclick="deleteTask(' + tasks[i].id + ')"></i>'
                        + '</td>'
                        + '</tr>';
                }

                $('#taskTable').html(html);
            },
            error: function (e) {
                console.error("API Error:", e.responseText);
            }
        });
    }

    function addTask() {
        resetCreateForm();
        $("#createTaskModal").modal('show');
    }

    function createTask() {
        var taskName = $('#taskName').val();
        var taskDescription = $('#taskDescription').val();
        var taskOwner = $('#taskOwner').val();
        var taskOwnerEmail = $('#taskOwnerEmail').val();
        var taskEta = $('#taskEta').val();

        $.ajax({
            url: 'http://localhost:8081/api/task',
            type: 'POST',
            data: {
                task_name: taskName,
                task_description: taskDescription,
                task_owner: taskOwner,
                task_owner_email: taskOwnerEmail,
                task_eta: taskEta
            },
            success: function (result) {
                console.log(result);
                $("#createTaskModal").modal('hide');
                resetCreateForm();
                getAllTasks();
            },
            error: function (e) {
                console.error(e.responseText);
            }
        });
    }

    function editTask(id) {
        $.ajax({
            url: 'http://localhost:8081/api/task/' + id,
            type: 'GET',
            success: function (result) {
                var task = result?.data || result;

                $('#editTaskName').val(task.task_name);
                $('#editTaskDescription').val(task.task_description);
                $('#editTaskOwner').val(task.task_owner);
                $('#editTaskOwnerEmail').val(task.task_owner_email);
                $('#editTaskEta').val(task.task_eta);
                $('#editTaskId').val(task.id);
                $('#editTaskStatus').val(task.status);
                $("#editTaskModal").modal('show');
            },
            error: function (e) {
                console.error(e.responseText);
            }
        });
    }

    function updateTask() {
        var id = $('#editTaskId').val();
        var taskName = $('#editTaskName').val();
        var taskDescription = $('#editTaskDescription').val();
        var taskOwner = $('#editTaskOwner').val();
        var taskOwnerEmail = $('#editTaskOwnerEmail').val();
        var taskEta = $('#editTaskEta').val();
        var taskStatus = $('#editTaskStatus').val();

        $.ajax({
            url: 'http://localhost:8081/api/task/' + id,
            type: 'PUT',
            data: {
                task_name: taskName,
                task_description: taskDescription,
                task_owner: taskOwner,
                task_owner_email: taskOwnerEmail,
                task_eta: taskEta,
                status: taskStatus
            },
            success: function (result) {
                console.log(result);
                document.activeElement.blur();
                $("#editTaskModal").modal('hide');
                resetEditForm();
                getAllTasks();
            },
            error: function (e) {
                console.error(e.responseText);
            }
        });
    }

    function markAsDone(id) {
        $('#markAsDoneId').val(id);
        $("#markAsDone").modal('show');
    }

    function updateMarkAsDone() {
        var id = $('#markAsDoneId').val();
        $.ajax({
            url: 'http://localhost:8081/api/task/done/' + id,
            type: 'POST',
            data: {
                status: 1
            },
            success: function (result) {
                console.log(result);
                $("#markAsDone").modal('hide');
                getAllTasks();
            },
            error: function (e) {
                console.error(e.responseText);
            }
        });
    }

    function deleteTask(id) {
        $('#deleteTaskId').val(id);
        document.activeElement.blur();
        $("#deleteTask").modal('show');
    }

    function updateTaskDelete() {
        var id = $('#deleteTaskId').val();
        $.ajax({
            url: 'http://localhost:8081/api/task/' + id,
            type: 'DELETE',
            success: function (result) {
                console.log(result.message);
                document.activeElement.blur(); 
                $("#deleteTask").modal('hide');
                setTimeout(() => {
                getAllTasks();
            }, 200);
            },
            error: function (e) {
                console.error(e.responseText);
            }
        });
    }

    function resetCreateForm() {
        $('#taskName, #taskDescription, #taskOwner, #taskOwnerEmail, #taskEta').val('');
    }

    function resetEditForm() {
        $('#editTaskName, #editTaskDescription, #editTaskOwner, #editTaskOwnerEmail, #editTaskEta, #editTaskStatus').val('');
    }

    $('#createTaskModal').on('hidden.bs.modal', function () {
        resetCreateForm();
    });

    $('#editTaskModal').on('hidden.bs.modal', function () {
        resetEditForm();
    });
</script>
@endsection
