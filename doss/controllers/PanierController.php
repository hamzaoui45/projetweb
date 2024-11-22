<?php
require_once 'models/Panier.php';
require_once 'config/database.php';

class PanierController {
    public function index() {
        $db = (new Database())->getConnection();
        $panier = new Panier($db);
        $result = $panier->getPanier();
        $articles = $result->fetchAll(PDO::FETCH_ASSOC);

        require 'views/panier.php';
    }

    public function add() {
        $db = (new Database())->getConnection();
        $panier = new Panier($db);

        if (isset($_POST['produit_id'], $_POST['quantite'])) {
            $panier->addProduit($_POST['produit_id'], $_POST['quantite']);
        }

        header("Location: index.php?controller=panier&action=index");
    }
}
?>
