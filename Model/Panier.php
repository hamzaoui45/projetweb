<?php
	class Panier{
		private $idPanier=null;
		private $idUser=null;
		private $idProduit=null;
		private $prixTotal=null;
		private $prix=null;
		private $quantite=null;
		//// Contructor
		function __construct($idProduit,$idUser,$quantite,$prix,$prixTotal){
			$this->idProduit=$idProduit;
			$this->idUser=$idUser;
            $this->quantite=$quantite;
			$this->prix=$prix;
			$this->prixTotal=$prixTotal;
		}

        /// Getters
		function getidPanier(){
			return $this->idPanier;
		}
		
		function getidUser(){
			return $this->idUser;
		}
		function getprixTotal(){
			return $this->prixTotal;
		}
		function getidProduit(){
			return $this->idProduit;
		}
		function getprix(){
			return $this->prix;
		}
		function getquantite(){
			return $this->quantite;
		}

		

		
       //// Setters
		function setidUser(string $idUser){
			$this->idUser=$idUser;
		}
		function setprixTotal(string $prixTotal){
			$this->prixTotal=$prixTotal;
		}
		

	}
?>