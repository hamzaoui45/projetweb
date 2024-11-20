<?php
require "../config.php";

class usercontroller
{
    // Select all users
    public function userList()
    {
        $sql = "SELECT * FROM user";
        $conn = config::getConnexion();

        try {
            $list = $conn->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Select a single user by ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $conn = config::getConnexion();

        try {
            $query = $conn->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a new user
    public function addUser($user) {
        $sql = "INSERT INTO user (nom, email, password, address, role, farm_name) 
                VALUES (:nom, :email, :password, :address, :role, :farm_name)";
        $conn = config::getConnexion();
    
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'address' => $user->getAddress(),
                'role' => $user->getRole(),
                'farm_name' => $user->getFarmName() // Insert farm_name if it's a Farmer
            ]);
    
            echo "User added successfully";
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    // Update an existing user
    public function updateUser($user, $id)
    {
        $sql = "UPDATE user SET 
                nom = :nom,
                nomFamille = :nomFamille,
                email = :email,
                password = :password,
                tel = :tel,
                adresse = :adresse,
                role = :role
            WHERE id = :id";
        $conn = config::getConnexion();

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'id' => $id,
                'nom' => $user->getNom(),
                'nomFamille' => $user->getNomFamille(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'tel' => $user->getTel(),
                'adresse' => $user->getAdresse(),
                'role' => $user->getRole()
            ]);

            echo $query->rowCount() . " record(s) updated successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete a user by ID
    public function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $conn = config::getConnexion();
        $query = $conn->prepare($sql);

        try {
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
