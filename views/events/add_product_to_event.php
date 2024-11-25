<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des produits à l'événement</title>
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

        .form-container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-container label,
        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h1>Ajouter des produits à l'événement</h1>
    <div class="form-container">
        <<form action="index.php?action=add_product_to_event&amp;event_id=<?= htmlspecialchars($event['id']); ?>"
            method="POST">
            <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['id']); ?>">

            <h2>Ajouter des produits à l'événement : <?= htmlspecialchars($event['titre']); ?></h2>

            <label for="produit_id">Choisir un produit :</label>
            <select name="produit_id" id="produit_id">
                <?php foreach ($produits as $produit): ?>
                    <option value="<?= $produit['id']; ?>"><?= htmlspecialchars($produit['nom']); ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Ajouter le produit</button>
            </form>

    </div>

</body>

</html>