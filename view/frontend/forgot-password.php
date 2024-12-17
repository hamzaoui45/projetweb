<?php 
require "../../Controller/usercontroller.php";
require "../../Model/user.php";
$userc=new UserController();
if (isset($_POST['submit'])){
    $email=$_POST['email'];
    $user=$userc->getbyemail($email);
    if(!$user){
        echo "<script>
                  alert('Please enter an existing email address.');
                  setTimeout(function() {
                    window.location.href = 'forgot-password.php';
                  }, 0);
                </script>"; 
    }else{
        echo "<script>
                  alert('An email has been sent to the provided address *.');
                  setTimeout(function() {
                    window.location.href = 'password_mail.php?email=". $email ."';
                  }, 0);
                </script>"; 
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
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

        input[type="email"] {
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
    <form id="forgot-password-form" action="" method="POST" autocomplete="off">
        <h2>Forgot Password</h2>
        <p>Enter your email address to reset your password</p>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="submit">Continue</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 AgriPlate. All rights reserved.</p>
</footer>
</body>
</html>
