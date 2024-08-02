<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Projets</title>
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
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: #ffffff;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        a, .btn {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
        .btn {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Liste des Projets</h1>
        <a href="{{ route('projects.create') }}" class="btn">Créer un Nouveau Projet</a>
    </header>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn">Modifier</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #e74c3c;">Supprimer</button>
                        </form>
                        <a href="{{ route('projects.showTasks', $project->id) }}" class="btn">Voir les Tâches</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>