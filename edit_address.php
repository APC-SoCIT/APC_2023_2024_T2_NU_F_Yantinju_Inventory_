<?php

$customer_session = $_SESSION['email'];

$get_customer = "SELECT * FROM nakatira WHERE email='$customer_session'";

$run_customer = mysqli_query($conn, $get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$address = $row_customer['address'];

$city = $row_customer['city'];

$province = $row_customer['province'];

$brgy = $row_customer['brgy'];

$pin_code = $row_customer['pin_code'];

?>

<h1 align="center" > </h1>

<form action="" method="post" enctype="multipart/form-data" ><!--- form Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label> Address: </label>

<input type="text" name="c_address" class="form-control" required value="<?php echo $address; ?>">


</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label> Province: </label>

<input type="text" name="c_province" class="form-control" required value="<?php echo $province; ?>">


</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label> City: </label>

<input type="text" name="c_city" class="form-control" required value="<?php echo $city; ?>">


</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label> Barangay: </label>

<input type="text" name="c_brgy" class="form-control" required value="<?php echo $brgy; ?>">


</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label> Postal Code: </label>

<input type="text" name="c_pin" class="form-control" required value="<?php echo $pin_code; ?>">


</div><!-- form-group Ends -->


<div class="text-left" ><!-- text-center Starts -->

<button name="update" class="btn btn-primary" >
Update Address

</button>


</div><!-- text-center Ends -->


</form><!--- form Ends -->

<?php

if(isset($_POST['update'])){

$c_address = $_POST['c_address'];

$c_province = $_POST['c_province'];

$c_city = $_POST['c_city'];

$c_brgy = $_POST['c_brgy'];

$c_pin = $_POST['c_pin'];

$update_address = "UPDATE nakatira SET address = '$c_address', province = '$c_province', city = '$c_city', brgy = '$c_brgy', pin_code = '$c_pin' WHERE email='$customer_session'";

$run_address = mysqli_query($conn, $update_address);

if($run_address){

echo "<script>alert('Your Address has been updated')</script>";

echo "<script>window.open('account.php?edit_address&confirm=logged_in','_self')</script>";

}

}


?>

