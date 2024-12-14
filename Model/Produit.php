<?php
	class Produit{
		private $idProduit=null;
		private $nomProduit=null;
		private $prix = null ;
	
		//// Contructor
		function __construct($nomProduit,$prix){
			$this->nomProduit=$nomProduit;
			$this->prix=$prix;
		}

        /// Getters
		function getidProduit(){
			return $this->idProduit;
		}
		

		function getnomProduit(){
			return $this->nomProduit;
		}
		function getprix(){
			return $this->prix;
		}
		
       //// Setters
		function setnomProduit(string $nomProduit){
			$this->nomProduit=$nomProduit;
		}
		function setprix(string $prix){
			$this->prix=$prix;
		}

	}
?>