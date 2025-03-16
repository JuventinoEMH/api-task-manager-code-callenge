<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

//use App\Http\Requests\StoreTaskRequest;
//use App\Http\Requests\UpdateTaskRequest;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    //'title', 'description', 'status', 'due_date're(Request $request)
    public function store(Request $request)
    {
         $fields =  $request ->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date|date_format:Y-m-d H:i:s',
        ]);
        $task = Task::create($fields);

        return ['task' => $task];
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $fields =  $request ->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date|date_format:Y-m-d H:i:s',
        ]);
        $task->update($fields);
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return ['message' => 'The task was deleted'];
    }
}
