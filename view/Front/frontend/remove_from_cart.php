<?php
include '../../../controller/PanierC.php';

$PanierC = new PanierC();
$idUser = 1; // Static user ID for demonstration

if (isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
    $PanierC->SupprimerProduitDuPanier($idProduit, $idUser);
    header('Location: panier.php'); // Redirect back to the cart page
    exit();
} else {
    echo "Invalid request!";
}
?>
