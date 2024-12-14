<?php
include '../../../controller/CommandeC.php';
include '../../../controller/PanierC.php';

$CommandeC = new CommandeC();
$PanierC = new PanierC();

if (isset($_GET['idPanier']) && isset($_GET['prixTotal'])) {
    $idPanier = $_GET['idPanier'];  // Get the idPanier from URL
    $prixTotal = $_GET['prixTotal'];  // Get the prixTotal from URL

    // Handle form submission
    if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['ville'])) {
        if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['ville'])) {
            // Create new Commande
            $Commande = new Commande(
                $idPanier,
                $_POST['nom'],
                $_POST['email'],
                $_POST['ville'],
                $prixTotal,
                "En Cours"
            );
            $CommandeC->AjouterCommande($Commande);  // Add the order
            header('Location: products.php');  // Redirect after successful order
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Command</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="462562198_1103487334732019_7215644507738509228_n (1).png" alt="AgriPlate Logo" width="120">
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="products.php">Products</a>
            <a href="panier.php">Panier</a>
            <a href="sellers.html">Sellers</a>
        </nav>
    </div>
</header>

<main>
    <section>
        <h1>Confirm Your Command</h1>
        <!-- Display Total Price -->
        <div class="total-price">
            <strong>Total Price: </strong>
            <span class="price"><?php echo number_format($prixTotal, 2); ?> €</span>
        </div>

        <!-- Command Form -->
        <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required><br><br>

        <p><strong>Prix Total:</strong> <?php echo htmlspecialchars($prixTotal); ?> €</p>

        <button type="submit">Ajouter Commande</button>
    </form>
    </section>
</main>

<footer>
    <p>© 2024 AgriPlate. All Rights Reserved.</p>
</footer>

<style>
/* General Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    line-height: 1.6;
    color: #333;
}

header {
    background-color: #28a745;
    color: #fff;
    padding: 20px 10px;
}

header .logo img {
    max-height: 50px;
}

header nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 15px;
}

header nav a:hover {
    text-decoration: underline;
}

main {
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.total-price {
    text-align: center;
    margin-bottom: 30px;
    font-size: 20px;
}

.price {
    color: #28a745;
    font-weight: bold;
}

/* Form Styling */
.command-form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.command-form .form-group {
    margin-bottom: 15px;
}

.command-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.command-form input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.command-form .btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 5px;
    cursor: pointer;
}

.command-form .btn:hover {
    background-color: #218838;
}

footer {
    background-color: #28a745;
    color: #fff;
    text-align: center;
    padding: 10px;
    margin-top: 20px;
}
</style>
</body>
</html>
