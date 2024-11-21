<?php

    class User {
        private $id;
        private $nom;
        private $nomFamille;
        private $email;
        private $password;
        private $tel;
        private $adresse;  
        private $role;
        
    
        public function __construct($id, $nom,$nomFamille, $email, $password,$tel, $adress, $role ) {
            $this->id = $id;
            $this->nom = $nom;
            $this->nomFamille= $nomFamille;
            $this->email = $email;
            $this->password = $password;
            $this->tel= $tel;
            $this->adresse = $adress;
            $this->role = $role;
            
        }
    
        

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nom
         */
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         */
        public function setNom($nom): self
        {
                $this->nom = $nom;

                return $this;
        }

        /**
         * Get the value of nomFamille
         */
        public function getNomFamille()
        {
                return $this->nomFamille;
        }

        /**
         * Set the value of nomFamille
         */
        public function setNomFamille($nomFamille): self
        {
                $this->nomFamille = $nomFamille;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         */
        public function setPassword($password): self
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of tel
         */
        public function getTel()
        {
                return $this->tel;
        }

        /**
         * Set the value of tel
         */
        public function setTel($tel): self
        {
                $this->tel = $tel;

                return $this;
        }

        /**
         * Get the value of adresse
         */
        public function getAdresse()
        {
                return $this->adresse;
        }

        /**
         * Set the value of adresse
         */
        public function setAdresse($adresse): self
        {
                $this->adresse = $adresse;

                return $this;
        }

        /**
         * Get the value of role
         */
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         */
        public function setRole($role): self
        {
                $this->role = $role;

                return $this;
        }
}
?>