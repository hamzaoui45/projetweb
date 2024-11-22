<?php
class Produit {
    private $conn;
    private $table = "produits";

    public $id;
    public $nom;
    public $description;
    public $prix;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }
    

    public function getProduits() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
