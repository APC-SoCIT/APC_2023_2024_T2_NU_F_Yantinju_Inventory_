<?php
session_start();
include "db_conn.php";

// Ensure that you have a valid database connection ($conn)

$archive_pid = $_GET['archive_product'];

$fetch_status_query = "SELECT status FROM paninda WHERE title='$archive_pid'";
$fetch_status_result = mysqli_query($conn, $fetch_status_query);

if(mysqli_num_rows($fetch_status_result) > 0) {
    $row = mysqli_fetch_assoc($fetch_status_result);
    $current_status = $row['status'];
    
    // Toggle the status
    $new_status = ($current_status == 'Archive') ? 'Available' : 'Archive';
    
    // Update the status in the database
    $update_status_query = "UPDATE paninda SET status='$new_status' WHERE title='$archive_pid'";
    $run_update = mysqli_query($conn, $update_status_query);
    
    if ($run_update) {
        echo "<script>window.open('adminpanel.php?products2','_self')</script>";
    } else {
        echo "Error updating product status: " . mysqli_error($conn);
    }
} else {
    echo "Product not found!";
}
?>
 