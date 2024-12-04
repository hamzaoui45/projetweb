<?php
session_start();
var_dump($_SESSION);

if(isset($_POST['submit'])){
    session_unset();
    header('Location: sessioncheck.php');
    exit(); // Ensure no further code is executed after the redirect
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>User Profile</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
    </head>
    
    <body>
        <form method="post">
            <button type="submit" name="submit" class="btn btn-primary">Unset</button> <!-- Added 'name="submit"' -->
        </form>
    </body>
</html>
