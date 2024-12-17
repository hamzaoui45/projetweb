<?php
session_start();  // Start the session to access session variables

include '../../Controller/usercontroller.php';
$UserC = new UserController();

// Retrieve the ID from the session (currently logged-in user's ID)
$userId = $_SESSION['User']['id'];

// Perform the deletion using the deleteUser method
$UserC->deleteUser($userId);

// Unset session variables and destroy the session
session_unset();
session_destroy(); // Optionally destroy the session to fully log the user out

// Once the deletion is complete, redirect to the user list page or login page
header('Location: index.php');  // Or 'Location: login.php' if you want to redirect to login
exit();
?>
