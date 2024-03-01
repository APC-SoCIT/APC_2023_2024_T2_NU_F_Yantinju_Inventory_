<?php
// Check if the user has confirmed the logout action
if (isset($_POST['confirm_logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect the user to the desired page after logout
    echo "<script>window.open('../login2.php','_self')</script>";
    exit(); // Exit to prevent executing the rest of the script
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout Confirmation</title>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-container">
        <div class="brand">
            <h3>
                <span class="las la-archive"></span>
                GAJJ
            </h3>
        </div>
        <div class="sidebar-avatar">
            <div>
                <img src="images/users/026d5c7a79c65be0a029cc5d6d397f10.jpg<?php //echo $_SESSION['img1'];?>" alt="avatar">
            </div>
            <div class="avatar-info">
                <div class="avatar-text">
                    <h4>Yantinju</h4>
                    <small>Gian Gandolpos<?//php echo $_SESSION['fname']; ?> <?php //echo $_SESSION['lname']; ?></small>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="adminpanel.php?dashboard" class="<?php if(isset($_GET['dashboard'])){ echo "active"; } ?>"><span class="las la-users"></span><span>Dashboard</span></a></li>
                <li><a href="adminpanel.php?products2" class="<?php if(isset($_GET['products2']) || isset($_GET['insert_products']) || isset($_GET['edit_product'])){ echo "active"; } ?>"><span class="las la-shopping-bag"></span><span>Products</span></a></li>
                <li><a href="adminpanel.php?view_customer" class="<?php if(isset($_GET['view_customer']) || isset($_GET['insert_admin'])){ echo "active"; } ?>"><span class="las la-chart-bar"></span><span>View Customers</span></a></li>      
                <li><a href="adminpanel.php?view_order" class="<?php if(isset($_GET['view_order']) || isset($_GET['view_detail'])){ echo "active"; } ?>"><span class="las la-file-invoice"></span><span>Customer's Order</span></a></li>
                <li><a href="adminpanel.php?report" class="<?php if(isset($_GET['report']) || isset($_GET['sales_report']) || isset($_GET['numusers_report']) || isset($_GET['topproduct_report'])){ echo "active"; } ?>"><span class="las la-calendar"></span><span>Reports</span></a></li>
                <li><a href="#" onclick="confirmLogout('<?php echo $_SERVER['REQUEST_URI']; ?>')"><span class="las la-door-open"></span><span>Logout</span></a></li> <!-- Call confirmLogout function on click and pass current URL -->
            </ul>
        </div>
    </div>
</div>
<!-- End of Sidebar -->

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
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms, submit the form to execute logout
            document.getElementById('logoutForm').submit();
        } else {
            // If the user cancels, redirect back to current page
            window.location.href = currentURL;
        }
    });
}
</script>

<!-- Form to submit the logout action -->
<form id="logoutForm" method="post">
    <!-- Add a hidden input field to pass the confirmation status -->
    <input type="hidden" name="confirm_logout" value="1">
</form>

</body>
</html>
