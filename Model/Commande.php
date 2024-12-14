<?php
	class Commande{
		private $idCommande=null;
		private $idPanier=null;
		private $nom=null;
		private $email=null;
		private $ville=null;
		private $prixTotal=null;
		private $etat=null;
		private $dateCreation=null;
		//// Contructor
		function __construct($idPanier,$nom,$email,$ville,$prixTotal,$etat){
			$this->idPanier=$idPanier;
			$this->nom=$nom;
			$this->email=$email;
			$this->ville=$ville;
            $this->prixTotal=$prixTotal;
			$this->etat=$etat;
		}

        /// Getters
		function getidCommande(){
			return $this->idCommande;
		}
		

		function getprixTotal(){
			return $this->prixTotal;
		}
		function getidPanier(){
			return $this->idPanier;
		}
		function getetat(){
			return $this->etat;
		}
		function getnom(){
			return $this->nom;
		}
		function getemail(){
			return $this->email;
		}
		function getville(){
			return $this->ville;
		}


		

		
       //// Setters
		function setidPanier(int $idPanier){
			$this->idPanier=$idPanier;
		}
		function setprixTotal(string $prixTotal){
			$this->prixTotal=$prixTotal;
		}
        function setetat(string $etat){
			$this->etat=$etat;
		}
		function setnom(string $nom){
			$this->nom=$nom;
		}
		function setemail(string $email){
			$this->email=$email;
		}
		function setville(string $ville){
			$this->ville=$ville;
		}
		

	}
?>