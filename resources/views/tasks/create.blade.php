<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Tâche</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
        }
        form {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Créer une Nouvelle Tâche</h1>
    </header>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="project_id">Projet :</label>
        <select id="project_id" name="project_id" required>
            <option value="" disabled selected>Choisissez un projet</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>

        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>

        <label for="status">Statut :</label>
        <select id="status" name="status" required>
            <option value="" disabled selected>Choisissez un statut</option>
            <option value="pending">En Attente</option>
            <option value="in_progress">En Cours</option>
            <option value="completed">Complété</option>
        </select>

        <button type="submit">Créer la Tâche</button>
    </form>

    <a href="{{ route('tasks.index') }}">Retour à la Liste des Tâches</a>
</body>
</html>