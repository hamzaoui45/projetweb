<?php
require_once 'models/Event.php';
require_once 'config/database.php';

class EventController
{
    private $db;
    private $eventModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->eventModel = new Event($this->db);
    }

    public function index()
    {
        // Récupération des événements depuis le modèle
        $events = $this->eventModel->read();

        // Vérifiez si la méthode retourne des résultats
        if ($events->rowCount() > 0) {
            // Passer les résultats à la vue
            include 'views/events/index.php';
        } else {
            // Afficher un message approprié si aucune donnée n'est disponible
            echo "Aucun événement trouvé.";
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->eventModel->titre = $_POST['titre'];
            $this->eventModel->date = $_POST['date'];
            $this->eventModel->longi = $_POST['longi'];
            $this->eventModel->lat = $_POST['lat'];
            $this->eventModel->id_user = 1; // Id statique

            if ($this->eventModel->create()) {
                header('Location: index.php');
            }
        }
        include 'views/events/create.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->eventModel->id = $id;
            $this->eventModel->titre = $_POST['titre'];
            $this->eventModel->date = $_POST['date'];
            $this->eventModel->longi = $_POST['longi'];
            $this->eventModel->lat = $_POST['lat'];

            if ($this->eventModel->update()) {
                header('Location: index.php');
            }
        }
        include 'views/events/edit.php';
    }

    public function delete($id)
    {
        $this->eventModel->id = $id;
        if ($this->eventModel->delete()) {
            header('Location: index.php');
        }
    }
    public function participate()
    {
        // Récupérer tous les événements
        $events = $this->eventModel->read();

        // Si un événement est sélectionné et que l'utilisateur n'est pas déjà inscrit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $event_id = $_POST['event_id'];
            $user_id = 1; // Assurez-vous que l'utilisateur est connecté et que son ID est dans la session

            // Vérifiez si l'utilisateur est déjà inscrit à cet événement
            $existingParticipation = $this->eventModel->checkParticipation($event_id, $user_id);

            if (!$existingParticipation) {
                // Ajouter l'utilisateur à l'événement
                $this->eventModel->joinEvent($event_id, $user_id);
                echo "Vous avez bien rejoint l'événement.";
            } else {
                echo "Vous êtes déjà inscrit à cet événement.";
            }
        }

        // Charger la vue
        include 'views/events/participate.php';
    }

    public function addProductToEvent($event_id)
{
    $event = $this->eventModel->getEventById($event_id);
    // Vérifier si la méthode est POST et qu'un produit est sélectionné
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produit_id'])) {
        $produit_id = 1;  // ID du produit sélectionné par l'utilisateur
        $user_id = 1;  // Récupérer l'ID de l'utilisateur connecté à partir de la session

        // Vérifier si l'utilisateur participe bien à cet événement
        if ($this->eventModel->checkParticipation($event_id, $user_id)) {
            // Ajouter le produit à l'événement dans la table event_produit
            $result = $this->eventModel->addProductToEvent($event_id, $produit_id, $user_id);
           

            if ($result) {
                // Rediriger vers la page des événements de l'utilisateur avec un message de succès
                header("Location: index.php?action=user_events&status=success");
                exit;
            } else {
                // Afficher un message d'erreur si l'ajout échoue
                echo "Une erreur est survenue lors de l'ajout du produit à l'événement.";
            }
        } else {
            // Afficher un message si l'utilisateur ne participe pas à cet événement
            echo "Vous ne participez pas à cet événement.";
        }
    } else {
        // Afficher la vue pour ajouter un produit à l'événement
        $produits = [
            ['id' => 1, 'nom' => 'Produit Statique 1'],  // Produit statique avec id 1
            ['id' => 2, 'nom' => 'Produit Statique 2'],  // Exemple d'ajout d'un autre produit statique
        ];            require 'views/events/add_product_to_event.php'; // Charger la vue
    }
}




    public function userEvents()
    {
        $user_id = 1; // ID de l'utilisateur connecté
        $events = $this->eventModel->getUserEvents($user_id);
        require 'views/events/user_events.php';
    }

    public function viewEventProducts($event_id)
{
    // Vérifier que l'utilisateur participe à l'événement
    $user_id = 1;
    if (!$this->eventModel->checkParticipation($event_id, $user_id)) {
        echo "Vous ne participez pas à cet événement.";
        return;
    }

    // Récupérer les produits associés à l'événement
    $products = $this->eventModel->getProductsByEventId($event_id);

    // Récupérer les détails de l'événement
    $event = $this->eventModel->getEventById($event_id);

    // Charger la vue
    require 'views/events/view_event_products.php';
}



}



?>