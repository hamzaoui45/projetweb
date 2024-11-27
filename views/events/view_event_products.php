<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits de l'événement</title>
    <img src="app/views/events/bbb.png">
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <h1>Produits pour l'événement : <?= htmlspecialchars($event['titre']); ?></h1>
    <ul>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <li><?= htmlspecialchars($product['id']); ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun produit ajouté à cet événement.</p>
        <?php endif; ?>
    </ul>
    <a href="index.php?action=user_events" style="display: block; text-align: center; margin-top: 20px;">Retour aux événements</a>
    

</body>
</html>
