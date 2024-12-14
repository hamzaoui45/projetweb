<?php
include '../../Controller/usercontroller.php';
$UserC = new usercontroller();

// Retrieve the ID passed in the URL using $_GET["id"]
$UserC->deleteUser($_GET["id"]);

// Once the deletion is complete, redirect to the user list page
header('Location:userlist.php');
?>