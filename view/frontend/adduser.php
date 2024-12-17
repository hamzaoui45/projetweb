<?php
// Include necessary files
include "../../Model/user.php";
include "../../Controller/usercontroller.php";

// Process form submission
if (
    isset($_POST["nom"]) && isset($_POST["nomFamille"]) && isset($_POST["email"]) &&
    isset($_POST["password"]) && isset($_POST["tel"]) && isset($_POST["adresse"]) &&
    isset($_POST["role"])
) {
    if (
        !empty($_POST["nom"]) && !empty($_POST["nomFamille"]) && !empty($_POST["email"]) &&
        !empty($_POST["password"]) && !empty($_POST["tel"]) && !empty($_POST["adresse"]) 
    ) {
        // Hash the password securely
        $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        // Save $hashedPassword to the database.
        
        // Create a new user object
        $user = new User(
            null,
            $_POST["nom"],
            $_POST["nomFamille"],
            $_POST["email"],
            $hashedPassword, // Save the hashed password
            $_POST["tel"],
            $_POST["adresse"],
            $_POST["role"]
        );

        // Add user to the database
        $userC = new UserController();
        $userC->addUser($user);

        // Redirect to a user list or success page
        header('Location: index.php');
        exit;
    } else {
        $error = "All fields are required, and role must be valid.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="C:\xampp\htdocs\projet web\view\admin\assets\logo.png" alt="AgriPlate Logo">
            </div>
            <div class="auth-buttons">
                <a href="index.html">Home</a>
            </div>
        </div>
    </header>
</head>

<body>
    <h1>Add User</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="nom">First Name:</label>
        <input type="text" name="nom" id="nom" >
        <span id="nomerror"></span>

        <label for="nomFamille">Last Name:</label>
        <input type="text" name="nomFamille" id="nomFamille" >
        <span id="nomFamilleerror"></span>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" >
        <span id="email"></span>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" >

        <label for="tel">Phone:</label>
        <input type="tel" name="tel" id="tel" >

        <label for="adresse">Address:</label>
        <input type="text" name="adresse" id="adresse" >

        <label for="role">Role:</label>
        <select name="role" id="role" >
            <option value="0">Client</option>
            <option value="1">Farmer</option>
            <option value="2">Admin</option>
        </select>

        <input type="submit" value="Save">
    </form>
    <script>
                document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");

            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                // Retrieve field values
                const fields = {
                    nom: document.getElementById("nom").value.trim(),
                    nomFamille: document.getElementById("nomFamille").value.trim(),
                    email: document.getElementById("email").value.trim(),
                    password: document.getElementById("password").value.trim(),
                    tel: document.getElementById("tel").value.trim(),
                    adresse: document.getElementById("adresse").value.trim(),
                    errornom:document.getElementById("nomerror"),
                    nomFamilleerror:document.getElementById("nomFamilleerror"),
                };

                let isValid = true;

                // Utility function to display error messages
                function displayError(fieldId, message) {
                    const field = document.getElementById(fieldId);
                    let errorMessage = field.nextElementSibling;

                    if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                        errorMessage = document.createElement("div");
                        errorMessage.classList.add('error-message');
                        field.parentNode.insertBefore(errorMessage, field.nextSibling);
                    }

                    errorMessage.textContent = message;
                    errorMessage.style.display = "block";
                }

                // Utility function to hide error messages
                function hideError(fieldId) {
                    const field = document.getElementById(fieldId);
                    const errorMessage = field.nextElementSibling;

                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.style.display = "none";
                    }
                }

                // Validate 'nom' (3-20 characters)
                if (fields.nom.length < 3 || fields.nom.length > 20) {
                    isValid = false;
                    fields.errornom.innerHTML="nom", "Le nom doit contenir entre 3 et 20 caractères.";
                    // displayError("nom", "Le nom doit contenir entre 3 et 20 caractères.");
                } else {
                    hideError("nom");
                }

                // Validate 'nomFamille' (3-20 characters)
                if (fields.nomFamille.length < 3 || fields.nomFamille.length > 20) {
                    isValid = false;
                    fields.nomFamilleerror.innerHTML="nomFamille", "Le nom de famille doit contenir entre 3 et 20 caractères.";
                    //displayError("nomFamille", "Le nom de famille doit contenir entre 3 et 20 caractères.");
                } else {
                    hideError("nomFamille");
                }

                // Validate 'email' (basic email pattern)
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(fields.email)) {
                    isValid = false;
                    displayError("email", "Veuillez entrer une adresse email valide.");
                } else {
                    hideError("email");
                }

                // Validate 'password' (minimum 6 characters)
                if (fields.password.length < 6) {
                    isValid = false;
                    displayError("password", "Le mot de passe doit contenir au moins 6 caractères.");
                } else {
                    hideError("password");
                }

                // Validate 'tel' (8 digits, starts with specific numbers)
                const phonePattern = /^(2|3|4|5|7|9)[0-9]{7}$/;
                if (!phonePattern.test(fields.tel)) {
                    isValid = false;
                    displayError("tel", "Le numéro doit contenir 8 chiffres et commencer par 2, 3, 4, 5, 7 ou 9.");
                } else {
                    hideError("tel");
                }

                // Validate 'adresse' (non-empty)
                if (fields.adresse.length === 0) {
                    isValid = false;
                    displayError("adresse", "L'adresse ne peut pas être vide.");
                } else {
                    hideError("adresse");
                }

                // Final check and form submission
                if (isValid) {
                    alert("Formulaire soumis avec succès !");
                    form.submit(); // Submit the form
                } else {
                    alert("Veuillez corriger les erreurs dans le formulaire.");
                }
            });
        });



        </script>
    
</body>

</html>