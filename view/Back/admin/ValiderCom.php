<?php
include_once '../../../Controller/CommandeC.php';
include_once '../../../Controller/PanierC.php';

$CommandeC = new CommandeC();
if (isset($_GET["idCommande"])) {
    $Commande = $CommandeC->RecupererCommande($_GET["idCommande"]);

    if ($Commande) {
        $Commande = new Commande(
            $Commande["idPanier"],
            $Commande["nom"],
            $Commande["email"],
            $Commande["ville"],
            $Commande['prixTotal'],
            "Livrée"
        );

        $CommandeC->ModifierCommande($Commande, $_GET["idCommande"]);

        // Debugging output
        echo "Commande ID: " . $_GET["idCommande"] . " updated to Livrée";

        // Redirect to the command list
        header("Location:AfficherCommandes.php");
        exit;
    } else {
        echo "Commande not found for ID: " . $_GET["idCommande"];
    }
} else {
    echo "Missing idCommande parameter!";
}
?>
