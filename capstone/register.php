<?php

session_start(); 
include "db_conn.php";
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['c_email']) && isset($_POST['c_pass'])) {

    $firstname = $_POST['c_first_name'];
    $lastname = $_POST['c_last_name'];
    $middlename = $_POST['c_middle_name'];
    $phone = $_POST['c_phone_no'];
    $email = $_POST['c_email'];
    $pass = $_POST['c_pass'];
    $bday = $_POST['c_b-day'];
    $gender = $_POST['c_gender'];
    $pic = 'default.jpg';
    $role = 'user';
    $phone2 = '0'. $phone;

    $check_email_query = "SELECT * FROM users WHERE email='$email' AND role='$role'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (!preg_match("/^09\d{0,9}$/", $phone)) {
        header("Location: signup.php?error=invalid_phone");
        exit();
    } else {

        // Check if email ends with "@gmail.com"
        if (substr($email, -10) !== "@gmail.com") {
            header("Location: signup.php?error=invalid_email");
            exit();
        } else {

            if (mysqli_num_rows($check_email_result) > 0) {
                header("Location: signup.php?error=email_exists");
                exit();
            } else {

                // Check if user is at least 17 years old
                $birthdate = new DateTime($bday);
                $now = new DateTime();
                $age = $now->diff($birthdate)->y;
                if ($age < 17) {
                    header("Location: signup.php?error=invalid_birthday");
                    exit();
                }

                $activation_token = bin2hex(random_bytes(16));

                $activation_token_hash = hash("sha256", $activation_token);

                $n=10;
                function get_id($n) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';

                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return strtoupper($randomString);
                }

                $customer_id = get_id($n);

                $insert_product = "INSERT INTO users (id, customer_id, firstname, lastname, middlename, phone, email, password, b_day, profilepic, gender, status, role, account_activation_hash) VALUES ('', '$customer_id', '$firstname', '$lastname', '$middlename', '$phone2', '$email', '$pass', '$bday', '$pic', '$gender', 'Activate', '$role', '$activation_token_hash')";
                $insert_address = "INSERT INTO nakatira (id, customer_id, email, address, province, city, brgy, pin_code) VALUES ('', '$customer_id', '$email', '', '', '', '', '')";

                $run_product = mysqli_query($conn, $insert_product);

                echo mysqli_query($conn, $insert_address);

                if ($run_product) {

                    try {
                        // Create a new PHPMailer instance
                        $mail = new PHPMailer(true);

                        //Server settings
                        $mail->isSMTP(); // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->Username = 'giangandolpos2003@gmail.com'; // SMTP username
                        $mail->Password = 'swgueepgbcvwiuqo'; // SMTP password
                        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 465; // TCP port to connect to

                        //Recipients
                        $mail->setFrom('giangandolpos2003@gmail.com', 'Yantinju Shop');
                        $mail->addAddress($email, $firstname); // Add a recipient

                        // Content
                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Subject = 'Welcome to Our Website';
                        $mail->Body = "Hello, $firstname $lastname! <br> 
                        Thank you for registering. Please click the link below to confirm your email and complete the registration process.<br>
                        You will be automatically redirected to the Homepage where you can then sign in.<br><br>
                        Please click below to activate your account.<br>
                        <a href='http://localhost/capstone/activate_account.php?token=$activation_token'>Activate</a>";

                        $mail->send();

                        header("Location: signup_success.php");
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>