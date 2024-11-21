<?php
session_start();
include '../../Controller/UserController.php';
include '../../Model/User.php';

$UserController = new UserController();

if (isset($_POST["email"]) && isset($_POST["password"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $user = $UserController->getByEmail($_POST["email"]);
        $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (!preg_match($emailPattern, $_POST["email"])) {
            echo "<script>
                  alert('Invalid email format. Please enter a valid email address.');
                  setTimeout(function() {
                    window.location.href = 'login.html';
                  }, 100);
                </script>";
        } elseif (!$user) {
            echo "<script>
                  alert('Email doesn’t exist. Please try another one.');
                  setTimeout(function() {
                    window.location.href = 'login.html';
                  }, 100);
                </script>";
        } elseif ($user['password'] != $_POST["password"]) {
            echo "<script>
                  alert('Email or password is invalid. Please try again.');
                  setTimeout(function() {
                    window.location.href = 'login.html';
                  }, 100);
                </script>";
        } else {
            // Save user in session
            $_SESSION["User"] = $user;

            // Redirect based on role
            if ($_SESSION["User"]["role"] == "0" || $_SESSION["User"]["role"] == "1") {
                header('Location: ../back/index.php'); // Redirect to user or farmer dashboard
            } elseif ($_SESSION["User"]["role"] == "2") {
                header('Location: /admin/index.html'); // Redirect to admin dashboard
            }
            exit;
        }
    } else {
        echo "<script>
              alert('Missing email or password.');
              setTimeout(function() {
                window.location.href = 'login.html';
              }, 100);
            </script>";
    }
}
?>
