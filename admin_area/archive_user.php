<?php
session_start();
include "db_conn.php";

// Ensure that you have a valid database connection ($conn)

$archive_pid = $_GET['archive_user'];

$fetch_status_query = "SELECT status FROM users WHERE customer_id='$archive_pid'";
$fetch_status_result = mysqli_query($conn, $fetch_status_query);

if(mysqli_num_rows($fetch_status_result) > 0) {
    $row = mysqli_fetch_assoc($fetch_status_result);
    $current_status = $row['status'];
    
    // Toggle the status
    $new_status = ($current_status == 'Disabled') ? 'Activate' : 'Disabled';
    
    // Update the status in the database
    $update_status_query = "UPDATE users SET status='$new_status' WHERE customer_id='$archive_pid'";
    $run_update = mysqli_query($conn, $update_status_query);
    
    if ($run_update) {
        echo "<script>window.open('adminpanel.php?view_customer','_self')</script>";
    } else {
        echo "Error updating User status: " . mysqli_error($conn);
    }
} else {
    echo "User not found!";
}
?>
 