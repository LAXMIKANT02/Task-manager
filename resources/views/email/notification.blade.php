
Dear {{ $data->task_owner }},<br><br>
The Task :{{ $data->task_description }}.<br><br>{{ $data->status == 0 ? " Has been added for you":"Has been Marked as Completed" }}<br><br>
@if($data->status == 0)
Kindly complete it by {{ $data->task_eta}},<br><br>
@endif

Thank you.