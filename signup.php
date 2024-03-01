<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Signup Form - Yantinju Shop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="admin_area/images/users/icon.jpg">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
        <!-- font awesome icons library-->
        <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/signup.css">

	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/bg-registration-form-1.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/registration-form-1.jpg" alt="">
				</div>
                
				<form method="post" action="register.php">
					<h3>SignUp Form</h3>
                        <?php if (isset($_GET['confirm']) && $_GET['confirm'] === "account_created") {
                            echo "<div class='alert alert-success alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-check'></i></div>
                                <strong>Success!</strong> Account has been registered successfully!
                            </div>";
                        } ?>
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];

                            if ($error === "invalid_phone") {
                                echo "<div class='alert alert-danger alert-white rounded'>
                                    <div class='icon'><i class='fa-solid fa-circle-exclamation'></i></div>
                                    <strong>$error!</strong> Your Phone Number is Invalid. Try Again!
                                </div>";
                            } elseif ($error === "email_exists") {
                                echo "<div class='alert alert-warning alert-white rounded'>
                                    <div class='icon'><i class='fa-solid fa-triangle-exclamation'></i></div>
                                    <strong>$error</strong>. This Email already exists. Try Again!
                                </div>";
                            } elseif ($error === "invalid_email") {
                                echo "<div class='alert alert-danger alert-white rounded'>
                                    <div class='icon'><i class='fa-solid fa-circle-exclamation'></i></div>
                                    <strong>$error</strong>. This Email is Invalid. Try Again!
                                </div>";
                            }

                            
                        } else if (isset($_GET['confirm']) && $_GET['confirm'] === 'logged_in') {
                            echo "<div class='alert alert-success alert-white rounded'>
                                <div class='icon'><i class='fa-solid fa-check'></i></div>
                                <strong>Success!</strong> Login successful!
                            </div>";
                        } else {
                            echo "<div class='alert alert-info alert-white rounded'>
                                <a href='https://www.privacy.gov.ph/wp-content/uploads/2016/07/updated-draft-July-12-2016.pdf'>
                                <div class='icon'><i class='fa-solid fa-book'></i></div></a>
                                <strong>Sign Up</strong> using your personal information
                            </div>";
                        }
                    ?>
					<div class="form-group">
                        <input type="text" id="c_first_name" name="c_first_name" placeholder="First Name" class="form-control" required>
                        <input type="text" name="c_last_name" placeholder="Last Name" class="form-control" required>
					</div>
					<div class="form-group">
                        <input type="text" id="input1" name="c_middle_name" placeholder="Middle Name" class="form-control">
                        <input type="number" id="phone" name="c_phone_no" placeholder="Phone Number" class="form-control" maxlength="11" required>
					</div>
                    <div class="form-wrapper">
                        <input type="email" name="c_email" placeholder="Email" class="form-control" required>
                        <i class="fa-solid fa-envelope"></i>                        
					</div>
                    <div class="form-wrapper">
                        <input type="password" name="c_pass" placeholder="Create password" class="form-control" required>
                        <i class="fa-solid fa-lock"></i>
					</div>
                    <div class="form-group">
						<select name="" id="input2" class="form-control">
							<option value="" disabled selected>Gender</option>
							<option value="male">Male</option>
							<option value="femal">Female</option>
							<option value="other">Other</option>
						</select>
                        <input type="date" name="c_b-day" placeholder="Bday" class="form-control" required>
					</div>
					<button>Sign Up
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
                    <div class="form-link">
                        <span>Already have account? <a href="login2.php" class="link signup-link">Login</a></span><br>
                    </div>
                    
				</form>
			</div>
		</div>
		
	</body>
    <script>

    document.getElementById("phone").addEventListener("input", function() {
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11);
            }
        });
    </script>
</html>