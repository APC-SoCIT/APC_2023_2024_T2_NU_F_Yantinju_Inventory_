<?php
session_start();
include "db_conn.php";

// Ensure that you have a valid database connection ($conn)

$delete_oid = $_GET['delete_order'];

// Assuming $conn is your database connection
$delete_order = "DELETE FROM `order` WHERE order_id='$delete_oid'";
$run_delete = mysqli_query($conn, $delete_order);

if ($run_delete) {
    echo "<script>window.open('account.php?my_orders','_self')</script>";
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}
?>
 