<?php
require 'usercontroller.php';

// Create an instance of the UserController
$userController = new UserController();

// Check for the 'action' parameter
if (isset($_GET['action']) && $_GET['action'] == 'getUserTotals') {
    // Get the filter parameter (default to 'All')
    $filter = $_GET['filter'] ?? 'All';

    // Call the `getUserTotals` method
    $total = $userController->getUserTotals($filter);

    // Return the result as JSON
    echo json_encode(['total' => $total]);
    exit;
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'userList') {
        // Get the role filter from the request
        $role = $_GET['role'] ?? null;

        // Fetch the user list using the controller
        $users = $userController->userList($role);

        // Return the data as JSON
        echo json_encode($users);
        exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'userList') {
    $role = $_GET['role'] ?? null;
    $column = $_GET['column'] ?? 'id'; // Default column
    $order = $_GET['order'] ?? 'ASC'; // Default order

    $userController = new UserController();
    $users = $userController->userList($role, $column, $order);

    echo json_encode($users);
    exit;
}

// Return an error for invalid actions
echo json_encode(['error' => 'Invalid action']);
exit;
