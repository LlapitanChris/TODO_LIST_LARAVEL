@extends('layouts.app')
@section('content')
<body>
	
    <div class="container">  

        <div class="panel panel-default">    
            <div class="panel-heading">
               <h2><i class="fas fa-tasks"></i> Task List</h2>
           </div>

           <div style="border: 1px solid black" class="panel-body">
            <!-- Display Validation Errors -->

            <!-- New Task Form -->
            <form action="/task" method="POST" class="form-horizontal">

                {{ csrf_field() }}
                <!-- Task Name -->               

                <div class="form-group">
                    <label for="task-name" class="control-label">Task</label>
                    <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">                    
                </div>

                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}
                </div>
                @endif

                <!-- Add Task Button -->
                <div class="form-group">                
                    <button type="submit" class="btn btn-default">
                       <i class="fas fa-plus-square"></i> Add Task
                   </button>
               </div>
           </form>
       </div>
   </div>
</div>


<!-- Current Tasks -->
@if (isset($tasks) && count($tasks) > 0)
<div class="panel panel-default">
    <div style="border: 1px solid black" class="panel-heading">
        Current Tasks
    </div>

    @if(Session::has('delete_message'))
    <div class="alert alert-danger">
        {{ Session::get('delete_message') }}
    </div>
    @endif

    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <th>Task</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td class="table-text">
                        <div class="card" style="width: 18rem;"> 
                          <div class="card-body">
                            <h5 class="card-title">{{ $task->id }}</h5>
                            <p class="card-text"><div>{{ $task->name }}</div></p>

                            <button type="button" class="btn btn btn-info" data-toggle="modal" onClick="openEditModal('{{ $task->id }}','{{ $task->name }}')"><i class="fas fa-pen-square"></i> Edit</button>

                            <button type="button" class="btn btn btn-danger" data-toggle="modal" onClick="openDeleteModal('{{ $task->id }}','{{ $task->name }}')"><i class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>      
        </table>

    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmationModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Delete</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete this task permanently?</p>
                <p>{{ $task->name }}</p>
            </div>
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div> 
{{-- Delete Modal --}}

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="editForm" method="POST">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="fas fa-pen-square"></i> Edit</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  {{ csrf_field()}}
                  {{ method_field('PATCH') }}       
                  <input style="width: 400px;" type="text" name="name" value="{{ $task->name }}">
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-info">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
</div> 
{{-- Edit Modal --}}


<script type="text/javascript">
    function openDeleteModal(id, name){ 
        $('#modal-content-task-name').html(name); /*this will call the modal content and task name on the form*/
        $('#deleteForm').attr('action','/task/'+id); /*declaring action of the deleteForm -form*/
        $('#deleteConfirmationModal').modal('show'); /*Modal will show thru id*/
    }


    function openEditModal(id, name){ 
        $('#modal-content-task-name').html(name); /*this will call the modal content and task name on the form*/
        $('#editForm').attr('action','/task/'+id+'/edit'); /*declaring action of the deleteForm -form*/
        $('#editModal').modal('show'); /*Modal will show thru id*/
    }
    
</script>
@endif

</div>
</body>
@endsection