<?php


session_start();
include "db_conn.php";

// Ensure that you have a valid database connection ($con)

    $delete_id = $_GET['delete_product'];
    
    // Assuming $con is your database connection
    $delete_pro = "DELETE FROM paninda WHERE title='$delete_id'";
    $run_delete = mysqli_query($conn, $delete_pro);

    if ($run_delete) {
        echo "<script>window.open('adminpanel.php?products2','_self')</script>";
    } else {
        echo "Error deleting product: " . mysqli_error($con);
    }
?>
