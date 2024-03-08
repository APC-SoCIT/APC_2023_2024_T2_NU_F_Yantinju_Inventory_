<?php
session_start(); 
include "db_conn.php";
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Sanitize form data to prevent injection attacks
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
            
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
            $mail->Username = 'giangandolpos2003@gmail.com';  // Your Gmail address
            $mail->Password = 'swgueepgbcvwiuqo';  // Your Gmail password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Sender and recipient
            $mail->setFrom($email, $name);
            $mail->addAddress('giangandolpos2003@gmail.com');

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'Message from Contact Form';
            $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            // Send email
            $mail->send();


            header("Location: homepage.php");
            ?>
            <script>
                Swal.fire({
                    title: 'Your message has been sent',
                    icon: 'success'
                });
            </script>
            <?php
        } catch (Exception $e) {
            // Failed to send email
            echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        }
    } else {
        // Required fields not filled
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}
?>
