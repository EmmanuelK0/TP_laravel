<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    // Afficher la liste des tâches avec filtrage et pagination
    public function index(Request $request)
    {
        $statusFilter = $request->input('status');
        $projectFilter = $request->input('project_id');

        $projects = Project::all();
        $query = Task::query()->with('project');

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        if ($projectFilter) {
            $query->where('project_id', $projectFilter);
        }

        $tasks = $query->paginate(10); // Ajout de la pagination

        return view('tasks.index', compact('tasks', 'projects', 'statusFilter', 'projectFilter'));
    }

    // Afficher le formulaire de création de tâche
    public function create()
    {
        $projects = Project::all(); // Récupérer tous les projets
        return view('tasks.create', compact('projects')); // Passer les projets à la vue
    }

    // Stocker une nouvelle tâche
    public function store(Request $request)
    {
        $rules = [
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed',
        ];

        $validatedData = $request->validate($rules);

        try {
            $task = new Task();
            $task->project_id = $validatedData['project_id'];
            $task->title = $validatedData['title'];
            $task->description = $validatedData['description'];
            $task->status = $validatedData['status'];
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
        } catch (\Exception $e) {
            // Enregistrer l'exception dans les logs et afficher un message d'erreur générique
            Log::error('Erreur lors de la création de la tâche : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de la tâche.');
        }
    }

    // Afficher le formulaire d'édition d'une tâche
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    // Mettre à jour une tâche existante
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed',
        ];

        $validatedData = $request->validate($rules);

        try {
            $task = Task::findOrFail($id);
            $task->title = $validatedData['title'];
            $task->description = $validatedData['description'];
            $task->status = $validatedData['status'];
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
        } catch (\Exception $e) {
            // Enregistrer l'exception dans les logs et afficher un message d'erreur générique
            Log::error('Erreur lors de la mise à jour de la tâche : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de la tâche.');
        }
    }

    // Supprimer une tâche
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
        } catch (\Exception $e) {
            // Enregistrer l'exception dans les logs et afficher un message d'erreur générique
            Log::error('Erreur lors de la suppression de la tâche : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de la tâche.');
        }
    }

    // Afficher les tâches filtrées par statut
    public function bystatus(string $status)
    {
        $tasks = Task::where('status', $status)->get();
        return view('tasks.index', compact('tasks'));
    }

    // Afficher les détails d'une tâche spécifique
    public function show($id)
    {
        $task = Task::with('project')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }
}
