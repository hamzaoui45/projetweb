<?php
//Définition de la classe Panier
class Panier {
    private $conn;
    private $table = "panier";
//2. Propriétés publiques de la classe
    public $id;
    public $produit_id;
    public $quantite;
//Le constructeur de la classe
    public function __construct($db) {
        $this->conn = $db;
    }

//Méthode addProduit
    public function addProduit($produit_id, $quantite) {
        $query = "INSERT INTO " . $this->table . " (produit_id, quantite) VALUES (:produit_id, :quantite)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':produit_id', $produit_id);
        $stmt->bindParam(':quantite', $quantite);
        return $stmt->execute();
    }
//Méthode getPanier
    public function getPanier() {
        $query = "SELECT p.nom, p.prix, pa.quantite 
                  FROM " . $this->table . " pa 
                  JOIN produits p ON pa.produit_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
