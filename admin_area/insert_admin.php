
        <div class="main-content">
        <header>
            <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title">
                <h1>Employee</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?view_customer">View Customer</a></li>
                        <li>Add Admin</li>
                    </ul>
                </p>
            </div>
            
        </header>
        <main>
            <section>
            <h3 class="section-head">Add Employee</h3>
            
                <form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > First Name </label>

                <div class="col-md-6" >

                <input type="text" name="firstname" class="form-control" required>

                </div>

                </div><!-- form-group Ends -->
                
                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Middle Name </label>

                <div class="col-md-6" >

                <input type="text" name="middlename" class="form-control" required>

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Last Name </label>

                <div class="col-md-6" >

                <input type="text" name="lastname" class="form-control" required>

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Phone No. </label>

                <div class="col-md-6" >

                <input type="number" id="phone" name="number" class="form-control" maxlength="10" required>

                </div>

                </div><!-- form-group Ends -->


                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Gmail </label>

                <div class="col-md-6" >

                <input type="text" name="gmail" class="form-control" required >

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Password </label>

                <div class="col-md-6" >

                <input type="password" name="password" class="form-control" required >

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Gender </label>

                <div class="col-md-6" >


                <select name="sex" class="form-control" >

                <option> Select Gender </option>
                <option> male </option>
                <option> female </option>

                </select>

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Birthday </label>

                <div class="col-md-6" >

                <input type="date" name="bday" class="form-control" required >

                </div>

                </div><!-- form-group Ends -->


                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" ></label>

                <div class="col-md-6" >

                <input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control" >

                </div>

                </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->

                </div><!-- panel-body Ends -->

                </div><!-- panel panel-default Ends -->

                </div><!-- col-lg-12 Ends -->

                </div><!-- 2 row Ends --> 


                </main>
                </div>


            </section>
        </main>
        </div>


<?php

if (isset($_POST['submit'])) {

$product_img1 = "default.jpg";
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$sex = mysqli_real_escape_string($conn, $_POST['sex']);
$no = mysqli_real_escape_string($conn, $_POST['number']);
$gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$bday = mysqli_real_escape_string($conn, $_POST['bday']);

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

$admin_id = get_id($n);

    $insert_admin = "INSERT INTO `admins` (id, admin_id, firstname, lastname, middlename, phone, email, password, b_day, profilepic, gender, role) VALUES ('', '$admin_id', '$firstname', '$lastname', '$middlename', '$no', '$gmail', '$password', '$bday', 'default.jpg', '$sex', 'admin')";

    $run_admin = mysqli_query($conn, $insert_admin);

    if ($run_admin) {
        ?>
        <script>
            swal({
                title: "New Admin",
                text: "Admin has been added successfully!",
                type: "success",
                showCancelButton: false, 
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Okay" // Changed from "cancelButtonText" to "confirmButtonText"
            }).then(function() {
        window.location.href = "adminpanel.php?view_customer"; // Replace "adminpanel.php" with the URL of the desired page
    });
        </script>
<?php
    }

  }

?>

<script>
   document.getElementById("phone").addEventListener("input", function() {
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
 </script>