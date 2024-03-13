<?php

session_start(); 
include "db_conn.php";

$token = $_GET["token"];
$token_hash = hash("sha256", $token);
// Create connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SELECT query to fetch user information
$sql = "SELECT * FROM users WHERE account_activation_hash = '$token_hash'";
$stmt = mysqli_query($conn, $sql);


    $row_user = mysqli_fetch_array($stmt);
        $pro_user = $row_user['customer_id'];

// Prepare and execute the UPDATE query to set account_activation_hash to NULL
$sql2 = "UPDATE users SET account_activation_hash = NULL WHERE customer_id = '$pro_user'";
echo mysqli_query($conn, $sql2);

?>
<html lang="en">
<head>
    <title>Account Activated</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="admin_area/images/users/icon.jpg">
	<title></title>
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
	</style>
	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
</head>
<body>
	<header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title">ACCOUNT ACTIVATED!</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">
            Account activated successfully. You can now <a href="login.php">log in</a>.</p>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2024 | All Rights Reserved</p>
	</footer>
</body>
</html>
