<?php
include "../../Controller/usercontroller.php"; // Include UserController
if (isset($_GET['id']) && isset($_GET['newStatus'])) {
    $id = intval($_GET['id']);
    $newStatus = $_GET['newStatus'];

    $userController = new UserController();
    try {
        $result = $userController->updateStatus($id, $newStatus); // Update the status
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit;
