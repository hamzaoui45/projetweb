<?php
include '../../../controller/CommandeC.php';


$message = "" ;
$CommandeC = new CommandeC();

$CommandeC->SupprimerCommande($_GET["idCommande"]);
header('Location:AfficherCommandes.php');

?>