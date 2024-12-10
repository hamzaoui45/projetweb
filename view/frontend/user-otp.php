<?php require_once "../../Controller/usercontroller.php"; 

$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>