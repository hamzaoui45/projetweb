<?php
include '../../Controller/usercontroller.php';
$UserC = new usercontroller();
$role=$_GET['role'];
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id=$_GET['id'];
    try {
        $UserC->deleteUser($id);
        header('Location: index.php');
        exit();
    } catch (Exception $e) {
        echo "Error while deleting user: " . $e->getMessage();
    }
} else {
    echo "Error: User ID not provided.";
}
?>
