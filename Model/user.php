<?php
    class User {
        private $id;
        private $nom;
        private $email;
        private $password;
        private $address;
        private $role;
        private $farm_name; // New field for Farmer
    
        public function __construct($id, $nom, $email, $password, $address, $role, $farm_name = null) {
            $this->id = $id;
            $this->nom = $nom;
            $this->email = $email;
            $this->password = $password;
            $this->address = $address;
            $this->role = $role;
            $this->farm_name = $farm_name;
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
         * Get the value of address
         */
        public function getAddress()
        {
                return $this->address;
        }

        /**
         * Set the value of address
         */
        public function setAddress($address): self
        {
                $this->address = $address;

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

        /**
         * Get the value of farm_name
         */
        public function getFarmName()
        {
                return $this->farm_name;
        }

        /**
         * Set the value of farm_name
         */
        public function setFarmName($farm_name): self
        {
                $this->farm_name = $farm_name;

                return $this;
        }
    }

   
    
?>