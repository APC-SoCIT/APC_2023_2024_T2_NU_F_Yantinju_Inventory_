<?php


session_start();
include "db_conn.php";

    $delete_name = $_GET['delete_order'];
    
    // Assuming $con is your database connection
    $delete_pro = "DELETE FROM `order` WHERE order_id='$delete_name'";
    $run_delete = mysqli_query($conn, $delete_pro);

    if ($run_delete) {
        echo "<script>alert('Order $delete_name has been deleted')</script>";
        echo "<script>window.open('adminpanel.php?view_order','_self')</script>";
    } else {
        echo "Error deleting product: " . mysqli_error($con);
    }

?>
