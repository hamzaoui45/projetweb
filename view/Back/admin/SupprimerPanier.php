<?php
include '../../../controller/PanierC.php';


$message = "" ;
$PanierC = new PanierC();

$PanierC->SupprimerPanier($_GET["idPanier"]);
header('Location:AfficherPaniers.php');

?>