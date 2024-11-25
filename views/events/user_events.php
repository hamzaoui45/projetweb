<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes événements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h1>Mes événements</h1>
    <div class="card-container">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <div class="card">
                    <h2><?= htmlspecialchars($event['titre']); ?></h2>
                    <p><strong>Date :</strong> <?= htmlspecialchars($event['date']); ?></p>
                    <p><strong>Longitude :</strong> <?= htmlspecialchars($event['longi']); ?></p>
                    <p><strong>Latitude :</strong> <?= htmlspecialchars($event['lat']); ?></p>
                    <!-- Bouton pour ajouter des produits à l'événement -->
                    <a href="index.php?action=add_product_to_event&event_id=<?= $event['id']; ?>" class="button">Ajouter des
                        produits</a>
                    <!-- Bouton pour voir les produits -->
                    <a href="index.php?action=view_event_products&event_id=<?= $event['id']; ?>" class="button">Voir</a>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun événement trouvé.</p>
        <?php endif; ?>
    </div>

</body>

</html>