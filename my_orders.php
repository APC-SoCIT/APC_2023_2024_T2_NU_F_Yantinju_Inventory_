
<center><!-- center Starts -->

<h1></h1>

<p class="lead"></p>

<p class="text-muted" style="margin-bottom:1rem;">

If you have any questions, please feel free to <a href="../contact.php" > contact us,</a> 

</p>


</center><!-- center Ends -->

<hr>

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover" ><!-- table table-bordered table-hover Starts -->

<thead><!-- thead Starts -->

<tr>

<th>#</th>
<th>Order ID</th>
<th>Purchased</th>
<th>Price</th>
<th>Order Date</th>
<th>Mode of Payment</th>
<th>Status</th>
<th>Action</th>


</tr>

</thead><!-- thead Ends -->

<tbody><!--- tbody Starts --->

<?php

$customer_session = $_SESSION['email'];

$get_customer = "SELECT * FROM users WHERE email='$customer_session'";

$run_customer = mysqli_query($conn, $get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$get_orders = "SELECT * from `order` where customer_id='$customer_id' AND order_id <> 'sold'";

$run_orders = mysqli_query($conn, $get_orders);

$i = 0;

while($row_orders = mysqli_fetch_array($run_orders)){

$order_id = $row_orders['order_id'];

$purchases = $row_orders['total_products'];

$price = $row_orders['total_price'];

$mop = $row_orders['method'];

$order_date = substr($row_orders['DateTime'],0,11);

$order_status = $row_orders['status'];

$i++;

$order_status1 = "<b style='color:green;'> $order_status </b>";


?>

<tr><!-- tr Starts -->

<th><?php echo $i; ?></th>

<td><?php echo $order_id; ?></td>

<td><?php echo $purchases; ?></td>

<td>₱<?php echo $price; ?></td>

<td><?php echo $order_date; ?></td>

<td><?php echo $mop; ?></td>

<td><?php echo $order_status1; ?></td>

<td>
<a href="delete_order.php?delete_order=<?php echo $order_id;?>" class="btn btn-success btn-xs <?= ($order_status == 'Product Delivered')?'':'disabled'; ?>"> Confirm If Received </a>
</td>


</tr><!-- tr Ends -->

<?php } ?>

</tbody><!--- tbody Ends --->


</table><!-- table table-bordered table-hover Ends -->

</div><!-- table-responsive Ends -->



