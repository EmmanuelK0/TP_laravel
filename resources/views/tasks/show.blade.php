<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Tâche</title>
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
        .container {
            width: 60%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            margin-top: 0;
        }
        .btn {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        p {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Détails de la Tâche</h1>
    </header>

    <div class="container">
        <h2>{{ $task->title }}</h2>
        <p><strong>Description :</strong> {{ $task->description }}</p>
        <p><strong>Statut :</strong> {{ ucfirst($task->status) }}</p>
        <p><strong>Projet :</strong> {{ $task->project->name }}</p>
        
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn">Modifier</a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        <a href="{{ route('tasks.index') }}" class="btn">Retour à la Liste des Tâches</a>
    </div>
</body>
</html>