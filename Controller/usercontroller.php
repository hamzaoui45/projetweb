<?php
require __DIR__ . "/../config.php";

class UserController
{
    public function userList($role = null, $column = 'id', $order = 'ASC')
    {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM user";

        // Ensure the order is valid
        if ($order !== 'ASC' && $order !== 'DESC') {
            $order = 'ASC';
        }

        // Ensure the column is valid
        $valid_columns = ["id", "nom", "nomFamille", "email"];
        if (!in_array($column, $valid_columns)) {
            $column = "id";
        }

        // Add filtering by role if provided
        if ($role) {
            $sql .= " WHERE role = :role";
        }

        // Add the ORDER BY clause
        $sql .= " ORDER BY $column $order";

        try {
            $stmt = $conn->prepare($sql);

            // Bind the role parameter if it's provided
            if ($role) {
                $stmt->bindParam(':role', $role);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    } 

    // Select one user by id
    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a new user
    public function addUser($user)
    {
        // Check if the email already exists
        $checkEmailSql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $conn = config::getConnexion();

        try {
            // Check if the email already exists
            $checkQuery = $conn->prepare($checkEmailSql);
            $checkQuery->execute(['email' => $user->getEmail()]);
            $emailCount = $checkQuery->fetchColumn();

            if ($emailCount > 0) {
                // If email exists, stop and show an error
                echo "Error: This email is already registered.";
                return;
            }

            // Prepare the SQL query to insert the new user
            $sql = "INSERT INTO user (nom, nomFamille, email, password, tel, adresse, role,status) 
                    VALUES (:nom, :nomFamille, :email, :password, :tel, :adresse, :role, :status)";
            
            $query = $conn->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'nomFamille' => $user->getNomFamille(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(), // Password should be hashed when creating the user
                'tel' => $user->getTel(),
                'adresse' => $user->getAdresse(),
                'role' => $user->getRole(),
                'status' => $user->getStatus()
            ]);

            echo "User inserted successfully!";
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Update an existing user
    public function updateUser($user, $id)
    {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE user SET 
                nom = :nom,
                nomFamille = :nomFamille,
                email = :email,
                password = :password,
                tel = :tel,
                adresse = :adresse,
                role = :role,
                status = :status
            WHERE id = :id'
        );

        try {
            $query->execute([
                'id' => $id,
                'nom' => $user->getNom(),
                'nomFamille' => $user->getNomFamille(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(), // Ensure password is hashed before updating
                'tel' => $user->getTel(),
                'adresse' => $user->getAdresse(),
                'role' => $user->getRole(),
                'status' => $user->getStatus()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete one user by id
    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM user WHERE id = :id";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getbyemail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':email' => $email
            ]);
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
        // Function to search users by 'nom'
    public function searchUserByNom($searchTerm) {
        try {
            // Get the database connection
            $db = config::getConnexion();
            
            // Prepare the SQL query with LIKE for partial matches
            $query = "SELECT * FROM user WHERE nom LIKE :searchTerm";
            
            // Prepare the statement
            $stmt = $db->prepare($query);

            // Bind the search term to the query with wildcard characters for partial matches
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            // Fetch and return the results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Handle any potential errors
            error_log("Error in search: " . $e->getMessage());
            return [];  // Return empty array in case of an error
        }
    }
    public function updatePassword($id, $mdp)
    {
        $sql = "UPDATE user SET password = :password WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':password', $mdp, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return true; // Return true if update is successful
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateStatus($id)
    {
        // Get the current status of the user
        $sql = "SELECT status FROM user WHERE id = :id";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $currentStatus = $query->fetch(PDO::FETCH_ASSOC)['status'];

            // Toggle the status
            $newStatus = ($currentStatus === 'Blocked') ? 'Unblocked' : 'Blocked';

            // Update the status in the database
            $updateSql = "UPDATE user SET status = :status WHERE id = :id";
            $updateQuery = $db->prepare($updateSql);
            $updateQuery->bindParam(':status', $newStatus, PDO::PARAM_STR);
            $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
            $updateQuery->execute();

            return true; // Return true if update is successful
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getUserTotals($filter)
    {
        $conn = config::getConnexion();
        $sql = "SELECT COUNT(*) as total FROM user";
        if ($filter === 'Clients') {
            $sql .= " WHERE role = 'Client'";
        } elseif ($filter === 'Farmers') {
            $sql .= " WHERE role = 'Farmer'";
        } elseif ($filter === 'Admins') {
            $sql .= " WHERE role = 'Admin'";
        }

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}
      

?>
