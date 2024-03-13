<?php

session_start();
include 'db_conn.php';

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
// Before the problematic section
if(isset($_POST['order_btn'])){

   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $number = $_POST['phone'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $address = $_POST['address'];
   $province = $_POST['prvnce'];
   $city = $_POST['city'];
   $brgy = $_POST['brgy'];
   $pin_code = $_POST['pin_code'];
   $status = "Confirmed Order";
   $currentDate = date("Y-m-d");
   $currentTime = date("H:i:s");

   $DateTime = date("Y-m-d H:i:s");

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE phone='{$_SESSION['phone']}'");

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE phone='{$_SESSION['phone']}'");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
       // Create an array to store changes to stock for each product
       $stock_changes = array();

      while($product_item = mysqli_fetch_assoc($cart_query)){
        $product_name[] = $product_item['title'] . ' (size ' . $product_item['size'] . ') ' . '(' . $product_item['quantity'] . ')';
        $product_price = $product_item['price'] * $product_item['quantity'];
        
        $cart_query2 = mysqli_query($conn, "SELECT stock FROM paninda WHERE title='{$product_item['title']}'");
        $product_item2 = mysqli_fetch_assoc($cart_query2);
        $current_stock = $product_item2['stock'] - $product_item['quantity']; 

        // Check if the current stock is zero, update the status to "archive"
        if ($current_stock <= 0) {
            mysqli_query($conn, "UPDATE paninda SET status = 'Archive' WHERE title='{$product_item['title']}'");
        }
        
            // Update stock in sizes table
            $update_size_query = mysqli_query($conn, "UPDATE `size` SET stock = stock - {$product_item['quantity']} WHERE id='{$product_item['product_id']}' AND size={$product_item['size']}");


            // Update stock in the paninda table
            mysqli_query($conn, "UPDATE paninda SET stock = stock - {$product_item['quantity']} WHERE title='{$product_item['title']}'");

            // Store the change in stock for each product
           //  if(!isset($stock_changes[$product_item['title']])){
            //    $stock_changes[$product_item['title']] = 0;
            //}
           // $stock_changes[$product_item['title']] += $product_item['quantity'];

        // Store the change in stock for each product
       // $stock_changes[$product_item['title']] = $current_stock;

        $price_total += $product_price; 
       
      } 
        $with_vat =  $price_total * .12;
        $final_amount = $price_total + $with_vat + 50;

   }

   
   $user = $_SESSION['email'];
   $user_info = mysqli_query($conn, "SELECT customer_id FROM users WHERE email='$user'");
   $row_users = mysqli_fetch_array($user_info);

   $customer_id = $row_users['customer_id'];

   $n=10;
   function get_id($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return strtoupper($randomString);
    }

    $order_id = get_id($n);

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(id, customer_id, order_id, fname, lname, number, email, method, address, province, city, brgy, pin_code, total_products, total_price, tax, status, DateTime) VALUES('', '$customer_id', '$order_id', '$fname', '$lname', '$number','$email','$method','$address','$province','$city','$brgy','$pin_code','$total_product','$final_amount', '$with_vat', '$status', '$DateTime')");

   mysqli_query($conn, "UPDATE nakatira SET address = '$address', province = '$province', city = '$city', brgy = '$brgy', pin_code = '$pin_code' WHERE email='$user'");
  
   if($cart_query && $detail_query){
      echo "

      
    <div class='overlaylay' id='overlaylay'></div> 

      <div class='receipt-container' id='receipt-container'>
        
      <div class='receipt_header'>
      <h1>Receipt of Sale <span>Yantinju Shop</span></h1>
      <h2>Address: $province, $address, $city, $brgy - $pin_code <span>Tel: $number</span></h2>
      </div>
  
      <div class='receipt_body'>
    
      
      <h2 style='text-align: center;'><span>$lname, $fname</span></h2>

          <div class='date_time_con'>
              <div class='date'>$currentDate</div>
              <div class='time'>$currentTime</div>
          </div>
  
          <div class='items'>
              <table>
          
                  <thead>
                      <th>QTY</th>
                      <th>ITEM</th>
                      <th>AMT</th>
                  </thead>
          
                  <tbody>";

        $total_price = 0; 
        $total_price2 = 0; 
        $with_vat = 0; 
        $final_price = 0; 
      
      // Fetch data from the cart table and populate table rows dynamically
      $cart_query2 = mysqli_query($conn, "SELECT * FROM `cart` WHERE phone='{$_SESSION['phone']}'");
      while ($product_item2 = mysqli_fetch_assoc($cart_query2)) {
          $quantity = $product_item2['quantity'];
          $product_name = $product_item2['title'];   
          $price_per_item = $product_item2['price'];
          $total_price += $quantity * $price_per_item;
          $total_price2 = $quantity * $price_per_item;
                
  
          echo "
          <tr style='height: 10px;'>
              <td>$quantity</td>
              <td>$product_name</td>
              <td>₱" . number_format($total_price2, 0) ."</td>
          </tr> ";
      }
      
      $with_vat = $total_price * 0.12; 
      $final_price = $total_price + $with_vat + 50;
          echo"
                  </tbody>
  
                  <tfoot>
                  
                    <tr>
                        <td style='width: 100px;'>Subtotal</td>
                        <td></td>
                        <td>₱" . number_format($total_price, 0) . "</td>
                    </tr>

                    <tr>
                        <td style='width: 100px;'>VAT 12%</td>
                        <td></td>
                        <td>₱" . number_format($with_vat, 0) . "</td>
                    </tr>

                      <tr>
                          <td style='width: 100px;'>Shipping Fee</td>
                          <td></td>
                          <td>₱50</td>
                      </tr>
                      
                      <tr>
                          <td>Total Fee</td>
                          <td></td>
                          <td>₱" . number_format($final_price) . "</td>
                      </tr>";
                    
                    echo "
  
                  </tfoot>
  
              </table>
          </div>
  
      </div>
  
  
  <h3>Thank You!</h3>
  <a href='products.php?confirm=logged_in'><h3 style='border-top:none;'>Exit</h3></a>

</div>";

echo "<script>showReceipt();</script>";

    $delete_query = mysqli_query($conn, "SELECT * FROM `cart`");
    if(mysqli_num_rows($delete_query) > 0){
        while($product_item = mysqli_fetch_assoc($delete_query)){
            $product_name = $product_item['title'];
            $product_size = $product_item['size']; 
            $product_id = $product_item['id']; 
            $no = $product_item['quantity']; 
            
            
            mysqli_query($conn, "DELETE FROM cart WHERE title='$product_name' AND phone={$_SESSION['phone']}");

            mysqli_query($conn, "UPDATE `size` SET stock = stock - $no WHERE id='$product_id' AND size='$product_size'");
        }
    }

     
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout - Yantinju Shop</title>
   <link rel="icon" href="admin_area/images/users/icon.jpg">
   <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/homepage.css">

    <!-- css library bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- font awesome icons library-->
    <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
    <!-- tailwind css library -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">

</head>
<body>
        <!-- this is your header -->
        <?php
            include 'header.php';
        ?>
        <!--    end of navbar    -->

            <div class="container">

            <section class="checkout-form" id="checkout-form">

            <form action="" method="post">

            <div class="display-order">
                <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE phone='{$_SESSION['phone']}'");
                    $total = 0;
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total = $total += $total_price;
                        $with_vat = $grand_total * .12;
                        $final_total = $grand_total + $with_vat + 50;
                ?>
                <span><?= $fetch_cart['title']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                <?php
                    }
                }else{
                    echo "<div class='display-order'><span>your cart is empty!</span></div>";
                }
                ?>
                <span class="grand-total"> grand total : ₱ <?= number_format($final_total, 2); ?></span>
            </div>

                    <?php 
                        
                        $get_pro = "SELECT * FROM nakatira WHERE email='{$_SESSION['email']}'";
                        $run_pro = mysqli_query($conn, $get_pro);

                        $row = mysqli_fetch_array($run_pro);
                        // Check if $row is not null before accessing its elements
                        if ($row) {
                            // $row contains data for each product from the database
                            $productShipping = $row['address'];
                            $province = $row['province'];
                            $city = $row['city'];
                            $brgy = $row['brgy'];
                            $pin_code = $row['pin_code'];
                        } else {
                            // Handle the case when $row is null (no data found)
                            // You can set default values or display an error message
                            $productShipping = "";
                            $province = "";
                            $city = "";
                            $brgy = "";
                            $pin_code = "";
                        }
                        ?>

                <div class="flex">
                    <div class="inputBox">
                        <input type="text" placeholder="First Name" name="fname" value="<?php echo $_SESSION['fname']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="last Name" name="lname" value="<?php echo $_SESSION['lname']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="email" placeholder="Email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="method" value="Cash on Delivery" readonly>
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="Address" name="address" value="<?php echo $productShipping; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="number" placeholder="Phone No." name="phone" value="<?php echo $_SESSION['phone']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="Province" name="prvnce" value="<?php echo $province; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="City" name="city" value="<?php echo $city; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="Barangay" name="brgy" value="<?php echo $brgy; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" placeholder="Postal Code" name="pin_code" value="<?php echo $pin_code; ?>" required>
                    </div>
                </div>
                <input type="submit" value="order now" class="sbmt-btn" name="order_btn" class="btn">
            </form>
                    
            </section>

            </div>

            <!-- custom js file link  -->
            <script>
            function showReceipt() {
                document.getElementById('receipt-container').style.display = 'block'; // Show the receipt
                document.getElementById('overlaylay').classList.add('show-overlaylay');
            }</script>


        
        <!-- this is your footer -->
        <?php
            include 'footer.php';
        ?>
        <!--    end of footer    -->

</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>