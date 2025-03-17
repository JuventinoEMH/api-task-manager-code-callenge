<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Project;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Gate;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    public function store(StoreTaskRequest $request, $projectId)
    {

        $project = Project::findOrFail($projectId);


        if (Gate::denies('create-task', $project)) {
            return response()->json(['error' => 'You do not have permission to create tasks for this project.'], 403);
        }


        $fields = $request->validated();

        if (empty($fields['status'])) {
            $fields['status'] = 'pending';
        }
        if (strtotime($fields['due_date']) > strtotime($project->deadline)) {
            return response()->json(['error' => 'The due date cannot be after the project deadline.'], 400);
        }


        $fields['project_id'] = $project->id;
        $fields['user_id'] = $request->user()->id;


        $task = $request->user()->tasks()->create($fields);


        return response()->json(['task' => $task], 201);
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
    public function update(UpdateTaskRequest $request, $projectId, Task $task)
    {

        if ($task->project_id !== (int) $projectId) {
            return response()->json(['error' => 'This task does not belong to the specified project.'], 403);
        }
        Gate::authorize('modify', $task);
        $fields = $request->validated();
        if (empty($fields['status'])) {
            $fields['status'] = 'pending';
        }
        $task->update($fields);
        return response()->json($task);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        Gate::authorize('modify', $task);
        $task->delete();
        return response()->json(['message' => 'The task was successfully deleted!'], 200);
    }
}
