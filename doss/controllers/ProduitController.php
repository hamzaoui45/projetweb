<?php
require_once 'models/Produit.php';
require_once 'config/database.php';

class ProduitController {
    public function index() {
        $db = (new Database())->getConnection();
        $produit = new Produit($db);
        $result = $produit->getProduits();
        $produits = $result->fetchAll(PDO::FETCH_ASSOC);

        require 'views/produits.php';
    }
}
?>
