<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    // Afficher la liste des projets
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Afficher le formulaire de création de projet
    public function create()
    {
        return view('projects.create');
    }
    
    // Stocker un nouveau projet
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];

        $validatedData = $request->validate($rules);

        // Créer et enregistrer le projet
        $project = new Project();
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->start_date = $validatedData['start_date'];
        $project->end_date = $validatedData['end_date'];
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    // Afficher les détails d'un projet spécifique (à implémenter)
    public function show(string $id)
    {
        // Implémentation future
    }

    // Afficher les tâches d'un projet spécifique
    public function showTasks(Project $project)
    {
        $tasks = $project->tasks;
        return view('projects.tasks', compact('project', 'tasks'));
    }

    // Afficher le formulaire d'édition d'un projet
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    // Mettre à jour un projet existant
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];

        $validatedData = $request->validate($rules);

        $project = Project::findOrFail($id);
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->start_date = $validatedData['start_date'];
        $project->end_date = $validatedData['end_date'];
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    // Supprimer un projet
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }
}