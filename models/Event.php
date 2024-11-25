<?php
class Event
{
    private $conn;
    private $table_name = "events";

    public $id;
    public $titre;
    public $date;
    public $longi;
    public $lat;
    public $id_user;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lire tous les événements
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Créer un événement
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (titre, date, longi, lat, id_user) 
                  VALUES (:titre, :date, :longi, :lat, :id_user)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':longi', $this->longi);
        $stmt->bindParam(':lat', $this->lat);
        $stmt->bindParam(':id_user', $this->id_user);

        return $stmt->execute();
    }

    // Mettre à jour un événement
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET titre = :titre, date = :date, longi = :longi, lat = :lat 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':longi', $this->longi);
        $stmt->bindParam(':lat', $this->lat);

        return $stmt->execute();
    }

    // Supprimer un événement
    public function delete()
{
    // Vérifier les participations associées
    $queryCheck = "SELECT COUNT(*) FROM event_participation WHERE event_id = :id";
    $stmtCheck = $this->conn->prepare($queryCheck);
    $stmtCheck->bindParam(':id', $this->id);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        echo "Impossible de supprimer cet événement : des participations y sont associées.";
        return false;
    }

    // Supprimer l'événement s'il n'a pas de participations associées
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $this->id);
    return $stmt->execute();
}


    // Vérifier si l'utilisateur est déjà inscrit à l'événement
    public function checkParticipation($event_id, $user_id)
    {
        $query = "SELECT * FROM event_participation WHERE event_id = :event_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Ajouter un utilisateur à un événement
    public function joinEvent($event_id, $user_id)
    {
        $query = "INSERT INTO event_participation (event_id, user_id) VALUES (:event_id, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    // Ajouter un produit à un événement
    public function addProductToEvent($event_id, $produit_id, $user_id)
    {
        // Requête pour insérer le produit dans la table `event_produit`
        $sql = "INSERT INTO event_produit (event_id, produit_id, user_id) VALUES (:event_id, :produit_id, :user_id)";
        $stmt = $this->conn->prepare($sql);
    
        // Lier les paramètres
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':produit_id', $produit_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
        // Exécuter la requête et vérifier le succès
        if ($stmt->execute()) {
            return true;  // Retourner true si l'ajout est réussi
        } else {
            return false;  // Retourner false si l'ajout échoue
        }
    }
    

    public function getUserEvents($user_id)
    {
        $query = $this->conn->prepare("
        SELECT e.id, e.titre, e.date, e.longi, e.lat 
        FROM events e
        INNER JOIN event_participation p ON e.id = p.event_id
        WHERE p.user_id = :user_id
    ");
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventById($event_id)
{
    $sql = "SELECT * FROM events WHERE id = :event_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif ou false si non trouvé
}

public function getProductsByEventId($event_id)
{
    $sql = "SELECT p.id 
            FROM event_produit ep
            INNER JOIN produits p ON ep.produit_id = p.id
            WHERE ep.event_id = :event_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




}
?>