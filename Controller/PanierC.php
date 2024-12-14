<?php
 	include_once dirname(__FILE__).'/../Config.php';
    include_once dirname(__FILE__).'/../model/Panier.php';

    class PanierC {




        /////..............................Afficher............................../////
                function AfficherPanier(){
                    $sql="SELECT * FROM panier";
                    $db = config::getConnexion();
                    try{
                        $liste = $db->query($sql);
                        return $liste;
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMessage());
                    }
                }
        
        /////..............................Supprimer............................../////
                function SupprimerPanier($idPanier){
                    $sql="DELETE FROM panier WHERE idPanier=:idPanier";
                    $db = config::getConnexion();
                    $req=$db->prepare($sql);
                    $req->bindValue(':idPanier', $idPanier);   
                    try{
                        $req->execute();
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMeesage());
                    }
                }
        
        
        /////..............................Ajouter............................../////
                function AjouterPanier($Panier){
                    $sql="INSERT INTO panier (idProduit,idUser,quantite,prix,prixTotal) 
                    VALUES (:idProduit,:idUser,:quantite,:prix,:prixTotal)";
                    
                    $db = config::getConnexion();
                    try{
                        $query = $db->prepare($sql);
                        $query->execute([
                            'idProduit' => $Panier->getidProduit(),
                            'idUser' => $Panier->getidUser(),
                            'quantite' => $Panier->getquantite(),
                            'prix' => $Panier->getprix(),
                            'prixTotal' => $Panier->getprixTotal(),
                    ]);	
                    }
                    catch (Exception $e){
                        echo 'Erreur: '.$e->getMessage();
                    }			
                }
        /////..............................Affichage par la cle Primaire............................../////
                function RecupererPanier($idPanier){
                    $sql="SELECT * from panier where idPanier=$idPanier";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $Panier=$query->fetch();
                        return $Panier;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }
                /////..............................tri............................../////
        function triPaniers(){
            $sql="SELECT * FROM panier order by prixTotal ASC";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }
        
        /////..............................Update............................../////
                function ModifierPanier($Panier,$idPanier){
                    try {
                        $db = config::getConnexion();
                $query = $db->prepare('UPDATE panier SET  idProduit = :idProduit,  idUser = :idUser , quantite = :quantite, prix = :prix , prixTotal = :prixTotal WHERE idPanier= :idPanier');
                        $query->execute([
                            'idProduit' => $Panier->getidProduit(),
                            'idUser' => $Panier->getidUser(),
                            'quantite' => $Panier->getQuantite(),
                            'prix' => $Panier->getprix(),
                            'prixTotal' => $Panier->getprixTotal(),
                            'idPanier' => $idPanier
                        ]);
                        echo $query->rowCount() . " records UPDATED successfully <br>";
                    } catch (PDOException $e) {
                        $e->getMessage();
                    }
                }


                function SupprimerProduitDuPanier($idProduit, $idUser){
                    $sql = "DELETE FROM panier WHERE idProduit = :idProduit AND idUser = :idUser";
                    $db = config::getConnexion();
                    $req = $db->prepare($sql);
                    $req->bindValue(':idProduit', $idProduit);
                    $req->bindValue(':idUser', $idUser);
                    try {
                        $req->execute();
                    } catch (Exception $e) {
                        die('Erreur: ' . $e->getMessage());
                    }
                }
                
                function getAllProductQuantities() {
                    $sql = "SELECT produits.nomProduit, SUM(panier.quantite) AS totalQuantity 
                            FROM panier 
                            JOIN produits ON panier.idProduit = produits.idProduit 
                            GROUP BY produits.nomProduit 
                            ORDER BY totalQuantity DESC";
                    $db = config::getConnexion();
                    try {
                        return $db->query($sql)->fetchAll();
                    } catch (Exception $e) {
                        die('Erreur: ' . $e->getMessage());
                    }
                }
                
                

                
        
        
    }
    

?>