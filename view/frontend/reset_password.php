<?php 
require "../../Controller/usercontroller.php";
require "../../Model/user.php";
session_start();

// Initialize variables
$id = $_GET['id'] ?? null;
$token = $_GET['token'] ?? null;

// Check if form is submitted
if (isset($_POST['submit']) && 
    isset($_SESSION['token']) && $_SESSION['token'] == $token || 
    isset($_SESSION['default_token']) && $_SESSION['default_token'] == $token) {

    // Fetch user by ID
    $userc = new UserController();
    $user = $userc->getUserById($id);

    // Retrieve form inputs
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($password != $confirmPassword) {
        echo "<script>
              alert('Passwords do not match.');
              setTimeout(function() {
                  window.location.href = 'reset_password.php?token=". $token ."&id=".$id."';
              }, 0);
              </script>"; 
    } else {
        // Proceed to update the password
        $newpassword = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['User']['password'] = $newpassword;
        $userc->updatePassword($id, $newpassword);
        unset($_SESSION['token']);

        if (!isset($_SESSION['default_token']) || $_SESSION['default_token'] != $token) {
            echo "<script>
                alert('Your password has been successfully updated.');
                setTimeout(function() {
                    window.location.href = 'login.html';
                }, 0);
                </script>"; 
        } else {
            echo "<script>
                alert('Your password has been successfully updated.');
                setTimeout(function() {
                    window.location.href = 'updateuser.php';
                }, 0);
                </script>"; 
        }
    }
} else if (!isset($token)) {
    echo "<script>alert('Invalid or expired token.'); window.location.href = 'login.html';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        .logo img {
            width: 150px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        form {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.8em;
            color: #4CAF50;
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            font-size: 0.9em;
            color: #555;
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            font-size: 0.9em;
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }

        footer {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto; /* Keeps footer at the bottom */
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="462562198_1103487334732019_7215644507738509228_n (1) copy.png" alt="AgriPlate Logo">
        </div>
    </div>
</header>

<main>
    <form id="reset-password-form" action="" method="POST" autocomplete="off">
        <h2>Reset Password</h2>
        <p>Enter your new password and confirm it below</p>

        <!-- Password Fields -->
        <input type="password" id="password" name="password" placeholder="Enter your new password" required>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>

        <button type="submit" name="submit">Reset Password</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 AgriPlate. All rights reserved.</p>
</footer>

</body>
</html>
