<?php
session_start();
include '../../Controller/usercontroller.php';
include '../../Model/user.php';
$id = $_SESSION['User']['id'];
$error = "";
// Create an instance of the controller
$userC = new UserController();
$user = $userC->getUserById($id); // Fetch the user details

$valid = 0;

// Check if the form is submitted and required fields are set
if (isset($_POST["submit1"])){
    if (!empty($_POST["nom"]) &&
        !empty($_POST["nomFamille"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"]) &&
        !empty($_POST["adresse"])
    ) {
        $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $namePattern = '/^[A-Za-z]+$/';
        $exist= $userC->getbyemail($_POST['email']);
        if (!preg_match($namePattern, $_POST["nom"])) {
            echo "<script>alert('Invalid first name format. Names should contain only letters.');</script>";
        } elseif (!preg_match($namePattern, $_POST["nomFamille"])) {
            echo "<script>alert('Invalid last name format. Names should contain only letters.');</script>";
        } elseif (!preg_match($emailPattern, $_POST["email"])) {
            echo "<script>alert('Invalid email format. Please enter a valid email address.');</script>";
        } elseif (!preg_match('/^\d{8,15}$/', $_POST["tel"])) { // Assuming 8-15 digit phone numbers
            echo "<script>alert('Invalid phone number. Only digits are allowed, and it must be between 8 and 15 characters long.');</script>";
        } elseif ($exist && $exist['id']!= $id) {
            echo "<script>alert('Email is already in use.');</script>";
        } else {
            $valid = 1; // Form validation passed
        }
    }
}

if ($valid == 1) {
    // Form is valid, proceed with updating the user

    // Check if the password has changed; if yes, hash it
    $password = $_SESSION["User"]["password"];
    $updatedRole = $_SESSION["User"]["role"]; 

    $user = new User(
        null,
        $_POST["nom"],
        $_POST["nomFamille"],
        $_POST["email"],
        $password,
        $_POST["tel"], // Assuming the phone number remains unchanged
        $_POST["adresse"], // Assuming the address remains unchanged
        $updatedRole
    );

    $userC->updateUser($user, $id);
    header('Location: index.php'); // Redirect to the user list page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .button{
            background-color: red ;
            color: #fff;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        .button1{
            background-color: orange ;
            color: #fff;
            border: none;
            cursor: pointer;
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
    <script>
        // JavaScript form validation
        function validateForm(event) {
            event.preventDefault();

            const nom = document.getElementById("nom").value.trim();
            const nomFamille = document.getElementById("nomFamille").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const tel = document.getElementById("tel").value.trim();
            const role = document.getElementById("role").value.trim();

            const emailPattern = /^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const namePattern = /^[A-Za-z]+$/;
            const phonePattern = /^\d{8,15}$/; // Adjust for your phone number requirements
            const validRoles = ["0", "1", "2"];

            if (!namePattern.test(nom)) {
                alert("Invalid first name format. Names should contain only letters.");
                return false;
            }

            if (!namePattern.test(nomFamille)) {
                alert("Invalid last name format. Names should contain only letters.");
                return false;
            }

            if (!emailPattern.test(email)) {
                alert("Invalid email format. Please enter a valid email address.");
                return false;
            }

            if (!phonePattern.test(tel)) {
                alert("Invalid phone number. Only digits are allowed, and it must be between 8 and 15 characters long.");
                return false;
            }

            document.getElementById("user").submit();
        }

    </script>
</head>

<body>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($user): ?>
        <!-- Fill the form with the user's data -->
        <form id="user" method="POST">
            <label for="nom">First Name:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>"><br>

            <label for="nomFamille">Last Name:</label>
            <input type="text" id="nomFamille" name="nomFamille" value="<?php echo $user['nomFamille']; ?>"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>

            <label for="tel">Phone:</label>
            <input type="text" id="tel" name="tel" value="<?php echo $user['tel']; ?>"><br>

            <label for="adresse">Address:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>"><br>

            <br>

            <input type="submit" name="submit1" value="Save">
        </form>
        <form method="POST" action="reset_password.php?token=allow&id=<?=$user['id']?>" onsubmit="return confirm('Are you sure you want to change your password ?');">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <button type="submit" class="button1">Reset password</button>
        </form>
         <!-- Delete button -->
        <form method="POST" action="deleteuser.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <button type="submit" class="button">Delete User</button>
        </form>
    <?php else: ?>
        <p style="color: red;">User not found.</p>
    <?php endif; ?>
</body>

</html>
