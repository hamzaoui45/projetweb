<?php
include '../../../controller/PanierC.php';

$PanierC = new PanierC();
$idUser = 1; // Static user ID for demonstration

if (isset($_POST['idProduit']) && isset($_POST['quantity'])) {
    $idProduit = $_POST['idProduit'];
    $quantity = intval($_POST['quantity']);

    // Fetch product price
    $produit = $PanierC->RecupererPanier($idProduit);
    if ($produit) {
        $price = $produit['prix'];
        $total = $price * $quantity;

        // Update the database
        $db = config::getConnexion();
        $sql = "UPDATE panier SET quantite = :quantity, prixTotal = :total WHERE idProduit = :idProduit AND idUser = :idUser";
        $query = $db->prepare($sql);
        $query->bindValue(':quantity', $quantity);
        $query->bindValue(':total', $total);
        $query->bindValue(':idProduit', $idProduit);
        $query->bindValue(':idUser', $idUser);
        $query->execute();

        echo "Cart updated successfully.";
    } else {
        echo "Product not found in cart.";
    }
} else {
    echo "Invalid input.";
}
?>
