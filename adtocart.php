<?php
session_start();
include "db_conn.php";

// Assuming 'products' is the key in the URL parameters
if(isset($_GET['products'])) {
   $productName = $_GET['products'];
   $sizenumber = $_GET['size'];

   $quantity = $_GET['quantity']; 

   // Use proper SQL syntax for SELECT query
   $phone = $_SESSION['phone'];
   $selected = "SELECT * FROM `cart` WHERE title='$productName' AND phone='$phone' AND size='$sizenumber'";
   $addcart = mysqli_query($conn, $selected);
   
   if($addcart) {
      // Check if the product is already in the cart
      if(mysqli_num_rows($addcart) > 0) {
         // Fetch product details
         $selected2 = "SELECT * FROM paninda WHERE title='$productName'";
         $addcart2 = mysqli_query($conn, $selected2);

         $row_edit = mysqli_fetch_array($addcart2);
         $title = $row_edit['title'];
         $price = $row_edit['price'];
         $category = $row_edit['category'];
         $id = $row_edit['id'];
         $stock = $row_edit['stock'];
         $phone = $_SESSION['phone'];

         $selected3 = "SELECT * FROM `cart` WHERE title='$title' AND size=$sizenumber";
         $addcart3 = mysqli_query($conn, $selected3);
         $row_edit2 = mysqli_fetch_array($addcart3);
         
         $stonk = $row_edit2['quantity'];

         if ($sizenumber <= 0){

            if($quantity > $stonk){
               $addquanty = $stock - $stonk;

               // Insert the product into the cart
               $updated = "UPDATE `cart` SET quantity = quantity + $addquanty WHERE phone = '$phone' AND title = '$title'";
               $updated_product = mysqli_query($conn, $updated);

               if ($updated_product) {
                  // Product added successfully
                  header("Location: products.php?success=2&count=" . urlencode($addquanty) ."&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              } else {
                  // Error adding product
                  header("Location: products.php?success=0&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              }

            } else {
               $addquanty = $quantity;
               

               // Insert the product into the cart
               $updated = "UPDATE `cart` SET quantity = quantity + $addquanty WHERE phone = '$phone' AND title = '$title'";
               $updated_product = mysqli_query($conn, $updated);

               if ($updated_product) {
                  // Product added successfully
                  header("Location: products.php?success=2&count=" . urlencode($quantity) ."&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              } else {
                  // Error adding product
                  header("Location: products.php?success=0&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              }

            }

         } else {

            $selected4 = "SELECT * FROM `size` WHERE id='$id' AND size=$sizenumber";
            $addcart4 = mysqli_query($conn, $selected4);
            $row_edit3 = mysqli_fetch_array($addcart4);
            $stonks = $row_edit3['stock'];

            if($quantity > $stonk){
               $addquanty = $stonks - $stonk;

               // Insert the product into the cart
               $updated = "UPDATE `cart` SET quantity = quantity + $addquanty WHERE phone = '$phone' AND title = '$title'";
               $updated_product = mysqli_query($conn, $updated);

               if ($updated_product) {
                  // Product added successfully
                  header("Location: products.php?success=2&count=" . urlencode($addquanty) ."&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              } else {
                  // Error adding product
                  header("Location: products.php?success=0&product=" . urlencode($addquanty) ."&confirm=logged_in");
                  exit();
              }

            } else {
               $addquanty = $quantity;

                  // Insert the product into the cart
                  $updated = "UPDATE `cart` SET quantity = quantity + $addquanty WHERE phone = '$phone' AND title = '$title'";
                  $updated_product = mysqli_query($conn, $updated);

               if ($updated_product) {
                  // Product added successfully
                  header("Location: products.php?success=2&count=" . urlencode($quantity) ."&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              } else {
                  // Error adding product
                  header("Location: products.php?success=0&product=" . urlencode($productName) ."&confirm=logged_in");
                  exit();
              }

            }
         }
         
      } else {
         // Fetch product details
         $selected2 = "SELECT * FROM paninda WHERE title='$productName'";
         $addcart2 = mysqli_query($conn, $selected2);

         $row_edit = mysqli_fetch_array($addcart2);
         $title = $row_edit['title'];
         $price = $row_edit['price'];
         $img1 = $row_edit['img1'];
         $pid = $row_edit['id'];
         $phone = $_SESSION['phone'];

         // Insert the product into the cart
         $inserted = "INSERT INTO `cart` (id, product_id, phone, title, price, img1, size, quantity) VALUES('', '$pid', '$phone', '$title', '$price', '$img1', '$sizenumber', '$quantity')";
         $insert_product = mysqli_query($conn, $inserted);

         if ($insert_product) {
            // Product added successfully
            header("Location: products.php?success=1&product=" . urlencode($productName) ."&confirm=logged_in");
            exit();
        } else {
            // Error adding product
            header("Location: products.php?success=0&product=" . urlencode($productName) ."&confirm=logged_in");
            exit();
        }
      }
   } else {
      
   }
} else {
  
}

?>
