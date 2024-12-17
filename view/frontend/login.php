<?php
session_start();
include '../../Controller/usercontroller.php';
include '../../Model/user.php';

$UserController = new UserController();


if (isset($_POST["email"]) && isset($_POST["password"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        // Fetch the user by email
        $user = $UserController->getByEmail($_POST["email"]);
        $emailPattern = '/^[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        // Validate email format
        if (!preg_match($emailPattern, $_POST["email"])) {
            echo "<script>
                  alert('Invalid email format. Please enter a valid email address.');
                  setTimeout(function() {
                    window.location.href = 'login.html';
                  }, 100);
                </script>";
                exit;
        }
        // Check if user exists
        elseif (!$user) {
            echo "<script>
                  alert('Email doesn’t exist. Please try another one.');
                  setTimeout(function() {
                    window.location.href = 'login.html';
                  }, 100);
                </script>";
                exit;
        }
        // Verify the entered password with the stored hashed password
        elseif (! password_verify($_POST['password'],$user['password']) ){
            echo "<script>
                  alert('Email or password is invalid. Please try again.');
                  setTimeout(function() {
                    window.location.href = 'login.html';
                  }, 100);
                </script>";
                exit;
        } elseif($user['status'] == "Blocked"){
          echo "<script>
                  alert('Blocked user can\'t login unless you contact Admin .');
                  window.location.href = 'index.php';
                </script>";
                exit;
        }
        // Successful login
        else {
          // Save user details in session
          $_SESSION["User"] = $user;
          // Redirect based on the user's role
          if ($_SESSION["User"]["role"] == "Client") {
              header('Location: index.php'); // Redirect to client dashboard
          } elseif ($_SESSION["User"]["role"] == "Farmer") {
              header('Location:index.php'); // Redirect to farmer dashboard
          } elseif ($_SESSION["User"]["role"] == "Admin") {
              header('Location: ../admin/index.php'); // Redirect to admin dashboard
          }
          exit; // Stop further script execution
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
