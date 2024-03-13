<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "db_conn.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

    $view_oid = $_GET['pay_order'];

    ?>

    <style>
        .upload_proof {
            border: none;
            width: 250px;
            height: 40px;
            margin-top: 17px;
            background: var(--black);
            font-size: 16px;
            color: #fff;
        }
    </style>
    <!-- Your HTML code for the form goes here -->
    <img src='images/gcash-payment2.jpg' alt='GCash Payment' width="250">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Proof of Cash-in:</label>
            <input type='file' name='proof_photo' accept='image/*' required>
        </div>
        <input type='submit' class='upload_proof' value='Upload Screenshot' name='upload_proof'>
        <input type='hidden' name='order_id' value='<?php echo $view_oid; ?>'>
    </form>

    <?php

    if (isset($_POST['upload_proof'])) {

        $profpic = $_FILES['proof_photo']['name'];
        $temp_profilepic = $_FILES['proof_photo']['tmp_name'];
        // Move the uploaded file to the destination directory
        move_uploaded_file($temp_profilepic, "admin_area/images/payments/$profpic");

        // Retrieve order_id from the hidden input field
        $order_id = $_POST['order_id'];

        // Update the order with the proof of payment
        $detail_done = mysqli_query($conn, "UPDATE `order` SET gcash_proof = '$profpic' WHERE order_id='$order_id'");

        if ($detail_done) {
            echo "<script>alert('Proof submitted successfully');</script>";
            echo "<script>window.open('account.php?my_orders&confirm=logged_in','_self')</script>";
        } else {
            echo "<script>alert('Failed to send a proof');</script>";
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
