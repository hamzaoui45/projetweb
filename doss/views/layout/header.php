<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Définition du jeu de caractères pour le document -->
    <meta charset="UTF-8">
    <!-- Définition de la vue pour le design réactif -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPlate - Agriculture Marketplace</title>
    <!-- Lien vers la feuille de style CSS pour le design de la page -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <div class="header-container">
        <!-- Logo de l'application -->
        <div class="logo">
            <img src="assets/images/logos/logo.png" alt="AgriPlate Logo" width="120">
        </div>
        <!-- Menu de navigation -->
        <nav>
            <a href="index.php?controller=produit&action=index">Home</a>
            <a href="index.php?controller=panier&action=index">Commande</a>
        </nav>
        <!-- Liens d'authentification : se connecter et s'inscrire -->
        <div class="auth-buttons">
            <a href="#">Log In</a>
            <a href="#">Sign Up</a>
        </div>
        <!-- Icône du panier qui, lorsqu'on clique, affiche le contenu du panier -->
        <div class="cart" onclick="toggleCart()">
            <img src="assets/images/icones/panier.png" alt="Cart Icon" height="30px"  width="30px">
            <!-- Contenu déroulant du panier (initialement vide) -->
            <div class="cart-dropdown" id="cartDropdown">
                <p style="color: red;">Your cart is empty.</p>
            </div>
        </div>
    </div>
</header>

<main>
    <!-- Titre principal de la page -->
    <h1 class="produits_texte"> COMMANDE EN LIGNE</h1>
    <hr>

    <section class="section_produits">
        <!-- Section contenant les produits disponibles à l'achat -->
        <div class="produits">
            <?php
            // Tableau contenant les informations des produits disponibles
            $produits = [
                [
                    'id' => 1,
                    'nom' => 'Tomate',
                    'description' => 'Une tomate fraîche et juteuse.',
                    'prix' => 5,
                    'image' => 'tomate.jpg' // Image associée au produit
                ],
                [
                    'id' => 2,
                    'nom' => 'Laitue',
                    'description' => 'Laitue verte croquante.',
                    'prix' => 3.5,
                    'image' => 'laitue.jpg'
                ],
                [
                    'id' => 3,
                    'nom' => 'Concombre',
                    'description' => 'Un concombre frais et croquant.',
                    'prix' => 4,
                    'image' => 'concombre.jpg'
                ]
            ];

            // Boucle pour afficher chaque produit dans la liste
            foreach ($produits as $produit): ?>
                <!-- Carte d'affichage du produit -->
                <div class="carte">
                    <!-- Section pour afficher l'image du produit -->
                    <div class="img">
                        <img src="assets/images/produits/<?php echo htmlspecialchars($produit['image']); ?>" 
                             alt="<?php echo htmlspecialchars($produit['nom']); ?>">
                    </div>
                    <!-- Section pour afficher la description du produit -->
                    <div class="desc"><?php echo htmlspecialchars($produit['description']); ?></div>
                    <!-- Titre du produit (nom) -->
                    <div class="titre"><?php echo htmlspecialchars($produit['nom']); ?></div>
                    <div class="box">
                        <!-- Affichage du prix du produit -->
                        <span class="prix" data-prix="<?php echo htmlspecialchars($produit['prix']); ?>">
                            <?php echo htmlspecialchars($produit['prix']); ?> DINAR
                        </span>
                        <!-- Bouton pour ajouter le produit au panier -->
                        <button class="achat" 
                                onclick="addToCart('<?php echo htmlspecialchars($produit['nom']); ?>', <?php echo htmlspecialchars($produit['prix']); ?>)">
                            Add to cart
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    
</main>

<script>
// Fonction JavaScript pour ajouter un produit au panier
function addToCart(nom, prix) {
    // Code pour ajouter un produit au panier
    console.log(nom + " ajouté au panier avec prix " + prix);
    // Ajoutez ici la logique pour gérer l'ajout au panier via JavaScript
}
</script>
</body>
</html>
