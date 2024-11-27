<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des événements</title>
    <link rel="stylesheet" href="style.css3">
    <img src="app/views/events/bbb.png">
    <style>
        /* Styles CSS pour la présentation de la page */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
        .button {
            padding: 5px 10px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        .button.red {
            background-color: #f44336;
        }
    </style>
</head>
<body>



    <h1>Liste des événements</h1>
    <a href="index.php?action=create" class="button">Ajouter un événement</a>

    <?php if ($events->rowCount() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $events->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['id']); ?></td>
                        <td><?= htmlspecialchars($event['titre']); ?></td>
                        <td><?= htmlspecialchars($event['date']); ?></td>
                        <td><?= htmlspecialchars($event['longi']); ?></td>
                        <td><?= htmlspecialchars($event['lat']); ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $event['id']; ?>" class="button">Modifier</a>
                            <a href="index.php?action=delete&id=<?= $event['id']; ?>" class="button red" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun événement trouvé.</p>
    <?php endif; ?>

</body>
</html>
