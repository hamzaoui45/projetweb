<?php
require "../../Controller/usercontroller.php";
session_start();
$errors = [];
$email = "";

// Check form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['check-email'])) {
    $email = trim($_POST['email']);

    // Validate email
    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        // Check if the email exists in the database
        $query = $db->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Email exists - generate OTP and save it (or retrieve existing OTP)
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp; // Store OTP in session
            $_SESSION['email'] = $email; // Store email in session

            // Optionally, save OTP to the database
            $updateQuery = $db->prepare("UPDATE users SET otp = ?, otp_expiry = ? WHERE email = ?");
            $updateQuery->execute([$otp, date('Y-m-d H:i:s', strtotime('+10 minutes')), $email]);

            // Send OTP to the user's email (you can implement your mail logic here)
            mail($email, "Your OTP Code", "Your OTP code is: $otp");

            // Redirect to user-otp.php
            header("Location: user-otp.php");
            exit;
        } else {
            // Email does not exist
            $errors[] = "This email address is not registered.";
        }
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
    <form action="forgot-password.php" method="POST" autocomplete="">
        <h2>Forgot Password</h2>
        <p>Enter your email address to reset your password</p>
        <?php if (!empty($errors) && count($errors) > 0): ?>
            <div class="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?><input type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
        <button type="submit" name="check-email">Continue</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 AgriPlate. All rights reserved.</p>
</footer>
</body>
</html>
