<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;


// Routes pour les projets
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');



Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('tasks/status/{status}', [TaskController::class, 'bystatus'])->name('tasks.bystatus');

// Routes pour les filtres et les tâches associées aux projets
Route::get('tasks/status/{status}', [TaskController::class, 'bystatus'])->name('tasks.bystatus');
Route::get('projects/{project}/tasks', [ProjectController::class, 'showTasks'])->name('projects.showTasks');


// Autres routes...

// Route pour afficher les détails d'une tâche
Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');



Route::resource('projects', ProjectController::class);