<?php
require __DIR__ . "/../config.php";

class UserController
{
    // Select all users
    public function userList()
    {
        $sql = "SELECT * FROM user";
        $conn = config::getConnexion();

        try {
            $liste = $conn->query($sql);
            return $liste;
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
            $sql = "INSERT INTO user (nom, nomFamille, email, password, tel, adresse, role) 
                    VALUES (:nom, :nomFamille, :email, :password, :tel, :adresse, :role)";
            
            $query = $conn->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'nomFamille' => $user->getNomFamille(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(), // Password should be hashed when creating the user
                'tel' => $user->getTel(),
                'adresse' => $user->getAdresse(),
                'role' => $user->getRole()
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
                role = :role
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
               
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete one user by id
    public function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $conn = config::getConnexion();
        $req = $conn->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        try {
            $req->execute();
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
    }
    
    
    

?>
