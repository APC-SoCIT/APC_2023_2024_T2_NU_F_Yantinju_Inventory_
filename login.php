<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	if (empty($email)) {
		header("Location: index.php?error=Email is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE email='$email' AND status='Activate' AND password='$pass'";
		$result = mysqli_query($conn, $sql);

		$sql2 = "SELECT * FROM admins WHERE email='$email' AND status='Activate' AND password='$pass'";
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $pass && $row['account_activation_hash'] === Null) {
				if ($row['role'] === 'user'){
					$_SESSION['fname'] = $row['firstname'];
					$_SESSION['lname'] = $row['lastname'];
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['pic'] = $row['profilepic'];
					$_SESSION['password'] = $row['password'];
					header("Location: homepage.php?confirm=logged_in");					
					exit();
				} else {
					header("Location: index.php?error=Incorrect Email or Password. Please try again");
					exit();
				} 
            }else{
				header("Location: index.php?error=Activate your Account before you log in");
		        exit();	
			}
		}else {
			$row2 = mysqli_fetch_assoc($result2);
            if ($row2['email'] === $email && $row2['password'] === $pass && $row2['account_activation_hash'] === Null) {
				if ($row2['role'] === 'admin'){
					$_SESSION['fname'] = $row2['firstname'];
					$_SESSION['lname'] = $row2['lastname'];
					$_SESSION['phone'] = $row2['phone'];
					$_SESSION['email'] = $row2['email'];
					$_SESSION['pic'] = $row2['profilepic'];
					$_SESSION['password'] = $row2['password'];
					header("Location: admin_area/adminpanel.php?dashboard");
					
					exit();
				} else {
					header("Location: index.php?error=Incorrect Email or Password. Please try again");
					exit();
				} 

            }else{
				header("Location: index.php?error=Activate your Account before you log in");
		        exit();	
			}
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}
?>