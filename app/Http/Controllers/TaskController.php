<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Session;
use Auth;


class TaskController extends Controller
{
	function showTaskForm(){
		$tasks = Task::orderBy('id','desc')->get();
		$tasks = Task::all();

		return view('tasks.todolists', compact('tasks'));

	}

	function addTask(Request $request){
		$tasks = new Task;
		$tasks->name = $request->name;
		$tasks->save();

		Session::flash('success_message', 'Task added successfully.');
		return redirect('/menu');
	}

	function deleteTask($id){
		$tasks = Task::find($id);
		$tasks->delete();
		Session::flash('delete_message', 'Task deleted successfully.');

		return redirect()->back();

	}

	function editTask(Request $request, $id){
		$tasks = Task::find($id);
		$tasks->name = $request->name;
		$tasks->save();
		
		Session::flash('success_message', 'Task updated successfully.');
		return redirect('/menu');
		

	}
}
