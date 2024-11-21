<?php
session_start();
include '../Controller/usercontroller.php';
include '../Model/User.php';

$id = $_GET['id'];
$error = "";

// Create an instance of the controller
$userC = new UserController();
$user = $userC->getUserById($id); // Fetch the user details

$valid = 0;

// Check if the form is submitted and required fields are set
if (
    isset($_POST["nom"]) &&
    isset($_POST["nomFamille"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["role"]) // Role field
) {
    // Server-side validation
    $exist = $userC->getByEmail($_POST["email"]);
    $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $namePattern = '/^[A-Za-z]+$/';
    $rolePattern = '/^[0-2]$/'; // Role must be 0, 1, or 2

    if (!preg_match($emailPattern, $_POST["email"])) {
        echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
    } elseif (!preg_match($namePattern, $_POST["nom"]) || !preg_match($namePattern, $_POST["nomFamille"])) {
        echo "<script>alert('Invalid name format. Names should contain only letters.');</script>";
    } elseif ($exist && $exist['id'] != $id) {
        echo "<script>alert('Email is already in use.');</script>";
    } elseif (!in_array($_POST["role"], ["0", "1", "2"])) {
        echo "<script>alert('Invalid role selected. Please choose a valid role.');</script>";
    }elseif (!preg_match($rolePattern, $_POST["role"])) {
        echo "<script>alert('Invalid role selected. Role must be 0 (Client), 1 (Farmer), or 2 (Admin).');</script>";
    } else {
        $valid = 1; // Form validation passed
    }
}

if ($valid == 1) {
    // Form is valid, proceed with updating the user
    $updatedRole = intval($_POST['role']); // Capture the selected role as integer

    $user = new User(
        null,
        $_POST["nom"],
        $_POST["nomFamille"],
        $_POST["email"],
        $_POST["password"],
        $_POST["tel"], // Assuming the phone number remains unchanged
        $_POST["adresse"], // Assuming the address remains unchanged
        $updatedRole
    );

    $userC->updateUser($user, $id);
    header('Location: userlist.php'); // Redirect to the user list page
    exit;
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
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($user): ?>
        <!-- Fill the form with the user's data -->
        <form id="user" method="POST">
            <label for="id">User ID:</label>
            <input type="text" id="id" name="id" readonly value="<?php echo $user['id']; ?>"><br>

            <label for="nom">First Name:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>"><br>

            <label for="nomFamille">Last Name:</label>
            <input type="text" id="nomFamille" name="nomFamille" value="<?php echo $user['nomFamille']; ?>"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>"><br>

            <label for="tel">Phone:</label>
            <input type="text" id="tel" name="tel" value="<?php echo $user['tel']; ?>"><br>

            <label for="adresse">Address:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>"><br>

            <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>client</option>
                <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>farmer</option>
                <option value="2" <?= $user['role'] == 2 ? 'selected' : '' ?>>admin</option>
            </select>
        </div>
            <input type="submit" value="Save">
        </form>
    <?php else: ?>
        <p style="color: red;">User not found.</p>
    <?php endif; ?>
</body>

</html>
