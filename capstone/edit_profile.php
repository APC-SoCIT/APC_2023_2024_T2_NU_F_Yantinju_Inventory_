 
<style>
.btn{
   border: none;
   width: 250px;
   height: 40px;
   margin-top: 17px;
   background: var(--black);
   font-size: 16px;
   color: #fff;
}
</style>
 <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include "db_conn.php";

    if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

        $customer_session = $_SESSION['email'];

        $get_customer = "SELECT * FROM users WHERE email='$customer_session'";
        $run_customer = mysqli_query($conn, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);

        $fname = isset($row_customer['firstname']) ? $row_customer['firstname'] : '';
        $mname = isset($row_customer['middlename']) ? $row_customer['middlename'] : '';
        $lname = isset($row_customer['lastname']) ? $row_customer['lastname'] : '';
        $gender = isset($row_customer['gender']) ? $row_customer['gender'] : '';
        $phone = isset($row_customer['phone']) ? $row_customer['phone'] : ''; // Set a default value for $phone
        $gmail = isset($row_customer['email']) ? $row_customer['email'] : '';
        $b_day = isset($row_customer['b_day']) ? $row_customer['b_day'] : '';
        $profilepic = isset($row_customer['profilepic']) ? $row_customer['profilepic'] : '';

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
            $phone = $_POST['phone'];

            // Check if a profile picture is uploaded
            if (!empty($_FILES['profilepic']['name'])) {
                $profilepic = $_FILES['profilepic']['name'];
                $temp_profilepic = $_FILES['profilepic']['tmp_name'];
                move_uploaded_file($temp_profilepic, "admin_area/images/users/$profilepic");
            }

            // Update user profile in the database
            $update_query = "UPDATE users SET phone='$phone', profilepic='$profilepic' WHERE email='$customer_session'";
            $run_update = mysqli_query($conn, $update_query);

            if ($run_update) {
                echo "<script>alert('Profile updated successfully');</script>";
            } else {
                echo "<script>alert('Failed to update profile');</script>";
            }
        }
    ?>

               <!-- <h1 style="font-size: 40px; margin-bottom: 20px;">Edit Profile</h1> -->

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Middle Name:</label>
                            <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                        </div>
                        <div class="form-group">
                            <label>Gmail:</label>
                            <input type="text" name="gmail" class="form-control" value="<?php echo $gmail; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Birthday:</label>
                            <input type="date" name="b_day" class="form-control" value="<?php echo $b_day; ?>">
                        </div>
                        <div class="form-group">
                            <label>Profile Picture:</label>
                            <input type="file" name="profilepic" class="form-control">
                            <img src="admin_area/images/users/<?php echo $profilepic; ?>" alt="Profile Picture" width="100">
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                    </form>
    <?php 
    } else {
        header("Location: index.php");
        exit();
    }
    ?>