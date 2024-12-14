<?php
include '../../../controller/PanierC.php';

$PanierC = new PanierC();

// Static user ID for demonstration
$idUser = 1;

if (isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];

    // Assume default quantity is 1
    $quantite = 1;

    // Fetch product price from the database (for simplicity, hardcoded here)
    include '../../../controller/ProduitC.php';
    $ProduitC = new ProduitC();
    $produit = $ProduitC->RecupererProduit($idProduit);
    $prix = $produit['prix'];

    // Calculate total price
    $prixTotal = $prix * $quantite;

    // Check if the product is already in the cart
    $cartItems = $PanierC->AfficherPanier();
    $found = false;

    foreach ($cartItems as $item) {
        if ($item['idProduit'] == $idProduit && $item['idUser'] == $idUser) {
            $found = true;
            $newQuantite = $item['quantite'] + $quantite;
            $newPrixTotal = $newQuantite * $prix;

            // Update cart item
            $PanierC->ModifierPanier(new Panier($idProduit, $idUser, $newQuantite, $prix, $newPrixTotal), $item['idPanier']);
        }
    }

    // Add a new item if not found
    if (!$found) {
        $PanierC->AjouterPanier(new Panier($idProduit, $idUser, $quantite, $prix, $prixTotal));
    }

    header('Location: products.php');
}
?>
