<?php
include "../Model/user.php";
include "../Controller/usercontroller.php";

$user = null;
$error = "";

// Create an instance of the controller
$userController = new usercontroller();

// Check if the necessary keys exist and are not empty
if (
    isset($_POST["nom"]) && isset($_POST["nomFamille"]) &&
    isset($_POST["email"]) && isset($_POST["password"]) &&
    isset($_POST["tel"]) && isset($_POST["adresse"]) &&
    isset($_POST["role"])
) {
    if (
        !empty($_POST["nom"]) && !empty($_POST["nomFamille"]) &&
        !empty($_POST["email"]) && !empty($_POST["password"]) &&
        !empty($_POST["tel"]) && !empty($_POST["adresse"]) &&
        !empty($_POST["role"])
    ) {
        // Create a User object from the submitted data
        $user = new user(
            null,
            $_POST['nom'],
            $_POST['nomFamille'],
            $_POST['email'],
            $_POST['password'],
            $_POST['tel'],
            $_POST['adresse'],
            $_POST['role']
        );

        // Call the updateUser function
        $usercontroller->updateUser($user, $_POST['id']);

        // Redirect to the user list page
        header('Location:userList.php');
    } else {
        // Display an error message if information is missing
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <?php
    // Check if the user ID is provided
    if (isset($_POST['id'])) {
        // Retrieve the user by ID
        $user = $userController->getUserById($_POST['id']);
    ?>
        <!-- Fill the form with the user's data -->
        <form id="user" action="" method="POST">
            <label for="id">User ID:</label>
            <input class="form-control form-control-user" type="text" id="id" name="id" readonly value="<?php echo $_POST['id'] ?>"><br>

            <label for="nom">First Name:</label>
            <input class="form-control form-control-user" type="text" id="nom" name="nom" value="<?php echo $user['nom'] ?>"><br>

            <label for="nomFamille">Last Name:</label>
            <input class="form-control form-control-user" type="text" id="nomFamille" name="nomFamille" value="<?php echo $user['nomFamille'] ?>"><br>

            <label for="email">Email:</label>
            <input class="form-control form-control-user" type="email" id="email" name="email" value="<?php echo $user['email'] ?>"><br>

            <label for="password">Password:</label>
            <input class="form-control form-control-user" type="password" id="password" name="password" value="<?php echo $user['password'] ?>"><br>

            <label for="tel">Phone:</label>
            <input class="form-control form-control-user" type="text" id="tel" name="tel" value="<?php echo $user['tel'] ?>"><br>

            <label for="adresse">Address:</label>
            <input class="form-control form-control-user" type="text" id="adresse" name="adresse" value="<?php echo $user['adresse'] ?>"><br>

            <label for="role">Role:</label>
            <input class="form-control form-control-user" type="text" id="role" name="role" value="<?php echo $user['role'] ?>"><br>

            <input type="submit" value="Save">
        </form>
    <?php
    }
    ?>
</body>

</html>
