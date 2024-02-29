<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu Starts -->
    <div class="panel-heading"><!-- panel-heading Starts -->
        <?php
        if (isset($_SESSION['email'])) {
            $customer_session = $_SESSION['email'];
            $get_customer = "SELECT * FROM users WHERE email='$customer_session'";
            $run_customer = mysqli_query($conn, $get_customer);
            $row_customer = mysqli_fetch_array($run_customer);
            $customer_image = $row_customer['profilepic'];
            $customer_name = $_SESSION['fname'] . ' ' . $_SESSION['lname'];
            if (!empty($customer_image)) {
                echo "<center><img src='admin_area/images/users/$customer_image' class='img-responsive' alt='Profile Picture'></center><br>";
                        
            } else {
                echo "<center><img src='default_profile_image.jpg' class='img-responsive' alt='Profile Picture'></center><br>";
            }
            echo "<h3 align='center' class='panel-title' style='font-family: Poppins, sans-serif'> Name: $customer_name </h3>";
        }
        ?>
    </div><!-- panel-heading Ends -->
    <div class="panel-body"><!-- panel-body Starts -->
        <ul class="nav nav-pills nav-stacked"><!-- nav nav-pills nav-stacked Starts -->
            <li class="<?php if (isset($_GET['my_orders'])) {
                echo "active";
            } ?>">
                <a href="account.php?my_orders"> <i class="fa fa-list"></i> My Orders </a>
            </li>
            <li class="<?php if (isset($_GET['edit_profile'])) {
                echo "active";
            } ?>">
                <a href="account.php?edit_profile"> <i class="fa-solid fa-id-badge"></i> Edit Profile </a>
            </li>
            <li class="<?php if (isset($_GET['edit_address'])) {
                echo "active";
            } ?>">
                <a href="account.php?edit_address"> <i class="fa fa-pencil"></i> Edit Address </a>
            </li>
            <li>
                <a href="#" onclick="confirmLogout('<?php echo $_SERVER['REQUEST_URI']; ?>')"><i class="fa fa-sign-out"></i> Logout</a>
            </li>
        </ul><!-- nav nav-pills nav-stacked Ends -->
    </div><!-- panel-body Ends -->
</div><!-- panel panel-default sidebar-menu Ends -->

<script>
// Function to show the SweetAlert confirmation dialog
function confirmLogout(currentURL) {
    Swal.fire({
        title: 'Are you sure you want to logout?',
        text: "You will be logged out of your account!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!',
        cancelButtonText: 'Cancel',
        customClass: 'sweet-alert-modal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms, submit the form to execute logout
            window.location.href = 'index.php';
        } else {
            // If the user cancels, redirect back to current page
            window.location.href = currentURL;
        }
    });
}
</script>


<style>
    /* Define styles for SweetAlert modals */
    .sweet-alert-modal{
        font-family: 'Poppins', sans-serif; /* Example: Override font family */
        font-size: 16px; /* Example: Override font size */
    }
</style>