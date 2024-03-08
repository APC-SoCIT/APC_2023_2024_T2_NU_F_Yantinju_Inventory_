<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log In Form - Yantinju Shop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="admin_area/images/users/icon.jpg">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
        <!-- font awesome icons library-->
        <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/index.css">

	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg.png');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/about-img.png" alt="">
				</div>
                
				<form method="post" action="login.php">
					<h3>Login Form</h3>
                        <?php if (isset($_GET['confirm']) && $_GET['confirm'] === "account_created") {
                            echo "<div class='alert alert-success alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-check'></i></div>
                                <strong>Success!</strong> Account has been registered successfully!
                            </div>";
                        } ?>
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            if ($error === "incorrect_email") {
                                echo "<div class='alert alert-warning alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-circle-exclamation'></i></div>
                                <strong>Warning!</strong> $error!
                            </div>";
                            } elseif ($error === "incorrect_password") {
                                echo "<div class='alert alert-danger alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-circle-exclamation'></i></div>
                                <strong>Error!</strong> $error!
                            </div>";
                            } else {
                                echo "<div class='alert alert-danger alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-circle-exclamation'></i></div>
                                <strong>Error!</strong> $error!
                            </div>";
                            }
                        } else if (isset($_GET['confirm']) && $_GET['confirm'] === 'logged_in') {
                            echo "<div class='alert alert-success alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-check'></i></div>
                                <strong>Success!</strong> Account has been login successful. Redirecting...!
                            </div>";
                        } else {
                            echo "<div class='alert alert-info alert-white rounded'>
                                <a href='https://www.privacy.gov.ph/wp-content/uploads/2016/07/updated-draft-July-12-2016.pdf'>
                                <div class='icon'><i class='fa-solid fa-book'></i></div></a>
                                <strong>Log In</strong> with your username and password
                            </div>";
                        }
                    ?>
					<div class="form-wrapper">
                        <input type="email" name="email" placeholder="Email Address" value="" class="form-control">
						<i class="fa-solid fa-envelope"></i>
					</div>
					<div class="form-wrapper">
                        <input type="password" name="password" placeholder="Password" value="" class="form-control">
						<i class="fa-solid fa-lock"></i>
					</div>
					<button>Log In
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
                    <div class="form-link" style="text-align: center;">
                    <span>Don't have an account? <a href="signup.php" class="link signup-link">Signup</a></span><br>
                    </div>
                    <div class="privacy-text" style="text-align: center;">
                    <a href="https://www.privacy.gov.ph/wp-content/uploads/2016/07/updated-draft-July-12-2016.pdf" style="text-decoration: underline;">Data Privacy Act</a><br>
                </div>
				</form>
			</div>
		</div>
		
	</body>
</html>