<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas para los proyectos
    Route::apiResource('/projects', ProjectController::class);

    // Rutas para las tareas asociadas a un proyecto específico
    Route::prefix('projects/{projectId}')->group(function () {
        Route::apiResource('/tasks', TaskController::class);
    });
});
//Route::delete('projects/{projectId}/tasks/{task}', [TaskController::class, 'destroy']);

//Route::put('projects/{projectId}/tasks/{task}', [TaskController::class, 'update']);




//Route::middleware('auth:sanctum')->group(function () {
//    Route::post('/logout', [AuthController::class, 'logout']);
//    Route::apiResource('/projects', ProjectController::class);
//    Route::apiResource('/tasks', TaskController::class);
//});


//Route::apiResource('tasks', TaskController::class);

// Public routes
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Route::apiResource('projects', ProjectController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('projects/{projectId}/stats', [ProjectController::class, 'getStats']);






