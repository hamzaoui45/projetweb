<?php
include "../Model/user.php";
include "../Controller/usercontroller.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $address = isset($_POST["adresse"]) ? $_POST["adresse"] : null;
    $role = isset($_POST["role"]) ? $_POST["role"] : null;
    $farm_name = isset($_POST["farm_name"]) ? $_POST["farm_name"] : null;

    // Validation for Client, Farmer, and Admin roles
    if (empty($nom) || empty($email) || empty($password) || empty($address)) {
        $error = "Please fill all required fields.";
    } else if ($role === "1" && empty($farm_name)) {
        $error = "Farm name is required for Farmer role.";
    } else {
        // Validating role selection
        if ($role !== "0" && $role !== "1" && $role !== "2") {
            $error = "Invalid role selected.";
        } else {
            // Create a new User object
            $user = new User(
                null, // ID will be auto-generated
                $nom,
                $email,
                password_hash($password, PASSWORD_BCRYPT), // Hash the password
                $address,
                $role,
                $role === "1" ? $farm_name : null // Only set farm name if role is Farmer
            );

            // Add the user to the database
            $userC = new usercontroller();
            $userC->addUser($user);

            // Redirect to login page after successful sign-up
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form method="post" action="" onsubmit="return validateForm()">
        <label for="nom">First Name:</label>
        <input type="text" name="nom" id="nom" onblur="validateName('nom')" required><br>

        <label for="nomFamille">Last Name:</label>
        <input type="text" name="nomFamille" id="nomFamille" onblur="validateName('nomFamille')" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" onblur="validateEmail()" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" onblur="validatePassword()" required><br>

        <label for="tel">Phone:</label>
        <input type="text" name="tel" id="tel" onblur="validatePhone()" required><br>

        <label for="adresse">Address:</label>
        <input type="text" name="adresse" id="adresse" onblur="validateAddress()" required><br>

        <!-- Additional fields for Farmer -->
        <div id="farmerFields" style="display: none;">
            <label for="farm_name">Farm Name:</label>
            <input type="text" name="farm_name" id="farm_name" placeholder="Enter your farm name" onblur="validateFarmName()">
        </div>

        <label for="role">Role:</label>
        <select name="role" id="role" onchange="toggleRoleFields()" required>
            <option value="0">Client</option>
            <option value="1">Farmer</option>
            <option value="2">Admin</option>
        </select><br>

        <!-- Error message -->
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <input type="submit" value="Sign Up">
    </form>

    <script>
        // Show/Hide farm name input for Farmer role
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            const farmerFields = document.getElementById('farmerFields');

            if (role === "1") {
                farmerFields.style.display = "block";
            } else {
                farmerFields.style.display = "none";
            }
        }

        // Validate the form before submission
        function validateForm() {
            let valid = true;
            // Validate each field
            if (!validateName('nom') || !validateName('nomFamille') || !validateEmail() || !validatePassword() || !validatePhone() || !validateAddress()) {
                valid = false;
            }
            if (document.getElementById('role').value === '1' && !validateFarmName()) {
                valid = false;
            }
            return valid;
        }

        // Validate First Name and Last Name
        function validateName(fieldId) {
            const field = document.getElementById(fieldId);
            if (field.value.trim() === '') {
                alert('Please enter a valid ' + fieldId);
                return false;
            }
            return true;
        }

        // Validate Email
        function validateEmail() {
            const email = document.getElementById('email').value;
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
            return true;
        }

        // Validate Password
        function validatePassword() {
            const password = document.getElementById('password').value;
            if (password.length < 6) {
                alert('Password must be at least 6 characters long');
                return false;
            }
            return true;
        }

        // Validate Phone (optional)
        function validatePhone() {
            const phone = document.getElementById('tel').value;
            const phonePattern = /^[0-9]{10}$/;  // Example for a 10-digit phone number
            if (phone && !phonePattern.test(phone)) {
                alert('Please enter a valid phone number');
                return false;
            }
            return true;
        }

        // Validate Address
        function validateAddress() {
            const address = document.getElementById('adresse').value;
            if (address.trim() === '') {
                alert('Please enter a valid address');
                return false;
            }
            return true;
        }

        // Validate Farm Name for Farmer role
        function validateFarmName() {
            const farmName = document.getElementById('farm_name').value;
            if (document.getElementById('role').value === "1" && farmName.trim() === '') {
                alert('Please enter a farm name for Farmer role');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
