<?php

require_once 'controllers/EventController.php';

$action = $_GET['action'] ?? 'index'; // Action par défaut
$id = $_GET['id'] ?? null; // ID passé dans l'URL (optionnel)
$event_id = $_GET['event_id'] ?? null; // Récupérer l'ID de l'événement

$controller = new EventController();

if ($action === 'index') {
    // Afficher la liste des événements
    $controller->index();
} elseif ($action === 'create') {
    // Créer un nouvel événement
    $controller->create();
} elseif ($action === 'edit' && $id) {
    // Modifier un événement existant
    $controller->edit($id);
} elseif ($action === 'delete' && $id) {
    // Supprimer un événement
    $controller->delete($id);
} elseif ($action === 'participate') {
    // Permettre à un utilisateur de participer à un événement
    $controller->participate();
} elseif ($action === 'join_event') {
    // Ajouter un utilisateur à un événement (soumission du formulaire)
    $controller->participate();
} 
elseif ($action === 'user_events') {
    $controller->userEvents();
}
elseif ($action === 'add_product_to_event' && $event_id) {
    $controller->addProductToEvent($event_id);}
    elseif ($action === 'view_event_products' && isset($_GET['event_id'])) {
        $controller->viewEventProducts($_GET['event_id']);
    }
 else {
    // Action non reconnue, redirigez ou affichez une erreur
    echo "Action non reconnue.";
}

?>
