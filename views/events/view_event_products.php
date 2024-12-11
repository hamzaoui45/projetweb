<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture & Food Marketplace</title>
    <link rel="stylesheet" href="styles.css">
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
<header>
    <div class="header-container">
        <div class="logo">
            <img src="bbb.png" alt="AgriPlate Logo" width="120">
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="products.html">Products</a>
            <a href="sellers.html">Sellers</a>
            <a href="index.php?action=participate">Events</a>

        </nav>
        <div class="auth-buttons">
            <a href="login.html">Log In</a>
            <a href="signup.html">Sign Up</a>

        </div>
        <div class="cart" onclick="toggleCart()">
            <img src="" alt="Cart Icon">
            <div class="cart-dropdown" id="cartDropdown">
                <p>Your cart is empty.</p>
            </div>
        </div>
    </div>
</header>
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

<footer>
    <p>© 2024 AgriPlate. All Rights Reserved. <a href="#">Privacy Policy</a></p>
</footer>
</html>
