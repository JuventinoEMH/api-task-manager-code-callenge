<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Foundation\Auth\Access\Authorizable;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Project::all();

        return Project::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $fields = $request->validated();
        $project = $request->user()->projects()->create($fields);

        return response()->json(['project' => $project], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        Gate::authorize('modify', $project);

        $fields = $request->validated();

        $project->update($fields);

        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Gate::authorize('modify', $project);

        $project->delete();

        return response()->json(['message' => 'The project was successfully deleted!'], 200);
    }

    public function getStats($projectId)
    {

        $project = Project::findOrFail($projectId);


        $tasks = $project->tasks;


        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status','completed')->count();
        $overdueTasks = $tasks->filter(function ($task) {
            return Carbon::parse($task->due_date)->isPast() && $task->status !== 'completed';
        })->count();


        return response()->json([
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'overdue_tasks' => $overdueTasks,
        ]);
    }




}
