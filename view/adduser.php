<?php
// Include necessary files
include "../Model/user.php";
include "../Controller/usercontroller.php";

// Process form submission
if (
    isset($_POST["nom"]) && isset($_POST["nomFamille"]) && isset($_POST["email"]) &&
    isset($_POST["password"]) && isset($_POST["tel"]) && isset($_POST["adresse"]) &&
    isset($_POST["role"])
) {
    if (
        !empty($_POST["nom"]) && !empty($_POST["nomFamille"]) && !empty($_POST["email"]) &&
        !empty($_POST["password"]) && !empty($_POST["tel"]) && !empty($_POST["adresse"]) &&
        ($_POST["role"] === "0" || $_POST["role"] === "1" || $_POST["role"] === "2")
    ) {
        // Create a new user object
        $user = new User(
            null,
            $_POST["nom"],
            $_POST["nomFamille"],
            $_POST["email"],
            $_POST["password"], // Consider hashing passwords
            $_POST["tel"],
            $_POST["adresse"],
            $_POST["role"]
        );

        // Add user to the database
        $userC = new UserController();
        $userC->addUser($user);
        // Redirect to a user list or success page
        header('Location:userList.php');
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
</head>

<body>
    <h1>Add User</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="nom">First Name:</label>
        <input type="text" name="nom" id="nom" >

        <label for="nomFamille">Last Name:</label>
        <input type="text" name="nomFamille" id="nomFamille" >

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" >

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
</body>

</html>
