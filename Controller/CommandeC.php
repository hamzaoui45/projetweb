<?php
 	include_once dirname(__FILE__).'/../Config.php';
    include_once dirname(__FILE__).'/../model/Commande.php';

    class CommandeC {




        /////..............................Afficher............................../////
                function AfficherCommande(){
                    $sql="SELECT * FROM Commande";
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
                function SupprimerCommande($idCommande){
                    $sql="DELETE FROM Commande WHERE idCommande=:idCommande";
                    $db = config::getConnexion();
                    $req=$db->prepare($sql);
                    $req->bindValue(':idCommande', $idCommande);   
                    try{
                        $req->execute();
                    }
                    catch(Exception $e){
                        die('Erreur:'. $e->getMeesage());
                    }
                }
        
        
        /////..............................Ajouter............................../////
                function AjouterCommande($Commande){
                    $sql="INSERT INTO Commande (idPanier,nom,email,ville,prixTotal,etat) 
                    VALUES (:idPanier,:nom,:email,:ville,:prixTotal,:etat)";
                    
                    $db = config::getConnexion();
                    try{
                        $query = $db->prepare($sql);
                        $query->execute([
                            'idPanier' => $Commande->getidPanier(),
                            'nom' => $Commande->getnom(),
                            'email' => $Commande->getemail(),
                            'ville' => $Commande->getville(),
                            'prixTotal' => $Commande->getprixTotal(),
                            'etat' => $Commande->getetat(),
                    ]);	
                    }
                    catch (Exception $e){
                        echo 'Erreur: '.$e->getMessage();
                    }			
                }
        /////..............................Affichage par la cle Primaire............................../////
                function RecupererCommande($idCommande){
                    $sql="SELECT * from Commande where idCommande=$idCommande";
                    $db = config::getConnexion();
                    try{
                        $query=$db->prepare($sql);
                        $query->execute();
        
                        $Commande=$query->fetch();
                        return $Commande;
                    }
                    catch (Exception $e){
                        die('Erreur: '.$e->getMessage());
                    }
                }
        /////..............................Update............................../////
        function ModifierCommande($Commande, $idCommande) {
            try {
                $db = config::getConnexion();
                $query = $db->prepare('
                    UPDATE Commande 
                    SET  
                        idPanier = :idPanier,  
                        nom = :nom, 
                        email = :email, 
                        ville = :ville, 
                        prixTotal = :prixTotal, 
                        etat = :etat 
                    WHERE idCommande = :idCommande
                ');
        
                // Debugging: Log values before execution
                echo "Debugging Values:<br>";
                echo "idPanier: " . $Commande->getidPanier() . "<br>";
                echo "nom: " . $Commande->getnom() . "<br>";
                echo "email: " . $Commande->getemail() . "<br>";
                echo "ville: " . $Commande->getville() . "<br>";
                echo "prixTotal: " . $Commande->getprixTotal() . "<br>";
                echo "etat: " . $Commande->getetat() . "<br>";
                echo "idCommande: " . $idCommande . "<br>";
        
                // Execute query
                $query->execute([
                    'idPanier' => $Commande->getidPanier(),
                    'nom' => $Commande->getnom(),
                    'email' => $Commande->getemail(),
                    'ville' => $Commande->getville(),
                    'prixTotal' => $Commande->getprixTotal(),
                    'etat' => $Commande->getetat(),
                    'idCommande' => $idCommande
                ]);
        
                // Debugging: Check affected rows
                echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage(); // Display the error
            }
        }
        
		function Recherche($ville){
			$sql="SELECT * from commande where ville like '".$ville."%' ";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


        function Tri(){
            $sql="SELECT * FROM commande order by etat ASC";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch(Exception $e){
                die('Erreur:'. $e->getMessage());
            }
        }

		
        function GetEtatStatistics() {
            $sql = "SELECT etat, COUNT(*) as count FROM commande GROUP BY etat";
            $db = config::getConnexion();
            try {
                $statistics = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                
                // Initialize default counts for each state
                $defaultStatistics = [
                    'En Cours' => 0,
                    'Livrée' => 0
                ];
        
                // Populate the default statistics with actual data from the query
                foreach ($statistics as $stat) {
                    if (array_key_exists($stat['etat'], $defaultStatistics)) {
                        $defaultStatistics[$stat['etat']] = (int)$stat['count'];
                    }
                }
        
                // Convert to the required format
                $finalStatistics = [];
                foreach ($defaultStatistics as $etat => $count) {
                    $finalStatistics[] = ['etat' => $etat, 'count' => $count];
                }
        
                return $finalStatistics;
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }

        
        
		public function getNumberOfCommands() {
			// Modify this query based on your database structure
			$query = "SELECT COUNT(*) as count FROM commande";
			$db = config::getConnexion();
			$stmt = $db->prepare($query);
			$stmt->execute();
		
			// Fetch the count
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
			return $result['count'];
		}
                
        
        
    }
    

?>