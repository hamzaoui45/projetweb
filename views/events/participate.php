<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participer à un événement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card h3 {
            margin: 0 0 10px;
        }
        .card p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1 style="width: 100%; text-align: center; margin-bottom: 20px;">Participer à un événement</h1>

    <?php foreach ($events as $event): ?>
        <div class="card">
            <h3><?= htmlspecialchars($event['titre']); ?></h3>
            <p><strong>Date :</strong> <?= htmlspecialchars($event['date']); ?></p>
            <p><strong>Longitude :</strong> <?= htmlspecialchars($event['longi']); ?></p>
            <p><strong>Latitude :</strong> <?= htmlspecialchars($event['lat']); ?></p>
            <form action="index.php?action=join_event" method="POST">
                <input type="hidden" name="event_id" value="<?= $event['id']; ?>">
                <button type="submit" class="button">Participer</button>
            </form>
        </div>
    <?php endforeach; ?>

</body>
</html>
