<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
    //
    public function index(){
    	$tasks = Task::all();
		//$tasks = DB::table('tasks')->get();
   		 return view('tasks/index', compact('tasks'));
         // get /tasks
    }

    public function show(Task $task){ // Task::find (wildcard);
    	//$task = Task::find($id);
    	//return $task;
		//dd($tasks);
    	return view('tasks/show', compact('task'));
        //get /tasks/id/
    }

    public function create(){

        //  /tasks/create
    }

    public function store(Request $request){

        //POST /tasks
    }

    public function edit($id){

        //GET /tasks/id/edit
        
    }

    public function update(Request $request, $id){

        //PATCH /tasks/id/
        
    }

    public function destroy($id){

        //DELETE /tasks/id
    }
}
