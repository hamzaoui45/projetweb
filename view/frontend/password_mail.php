<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require "../../Controller/usercontroller.php";
require "../../Model/user.php";

$userc=new UserController();
$email=$_GET['email'];
$user=$userc->getbyemail($email);
$name = $user['nom'];
$token = bin2hex(random_bytes(32)); // Generates a 64-character random token
$_SESSION['token']=$token;
$id=$user['id'];
$link='localhost/hamza_web/view/frontend/reset_password.php?token=' . $token .'&id='. $id ;

//Load Composer's autoloader
require '../../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hamza24benyahia@gmail.com';                     //SMTP username
    $mail->Password   = 'vgot afwk qxou cdbh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('AgriPlate@gmail.com', 'AgriPlate');
    $mail->addAddress($email,$name); 
    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Password Change Request';
    $mail->Body = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f9;
                    color: #333;
                    line-height: 1.6;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: auto;
                    background: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                .btn {
                    display: inline-block;
                    background: #007bff;
                    color: #ffffff;
                    text-decoration: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    font-size: 16px;
                    font-weight: bold;
                    margin-top: 20px;
                }
                .btn:hover {
                    background: #0056b3;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 14px;
                    color: #555;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Password Change Request</h2>
                <p>Hello ' . $name .' we received a request to reset your password. If you made this request, click the link below to reset your password:</p>
                <a href="' . $link . '" class="btn">Reset My Password</a>
                <p>If you did not request this password change, please ignore this email. Your password will remain unchanged.</p>
                <div class="footer">
                    <p>If you have any questions, contact our support team.</p>
                    <p>&copy; 2024 AgriPlate. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>';
    $mail->AltBody = 'We received a request to reset your password. If you made this request, visit this link: ' . $link . ' If you did not request this password change, please ignore this email.';
    
    $mail->send();
    header('Location: index.php');
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}