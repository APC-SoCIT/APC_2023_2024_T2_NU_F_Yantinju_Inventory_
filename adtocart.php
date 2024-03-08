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
   $selected = "SELECT * FROM `cart` WHERE title='$productName' AND phone='$phone'";
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
         $phone = $_SESSION['phone'];

         // Insert the product into the cart
         $updated = "UPDATE `cart` SET quantity = quantity + $quantity WHERE phone = '$phone' AND title = '$title'";
         $updated_product = mysqli_query($conn, $updated);

         if ($updated_product) {
            // Product added successfully
            header("Location: products.php?success=2&product=" . urlencode($productName) ."&confirm=logged_in");
            exit();
        } else {
            // Error adding product
            header("Location: products.php?success=0&product=" . urlencode($productName) ."&confirm=logged_in");
            exit();
        }
      } else {
         // Fetch product details
         $selected2 = "SELECT * FROM paninda WHERE title='$productName'";
         $addcart2 = mysqli_query($conn, $selected2);

         $row_edit = mysqli_fetch_array($addcart2);
         $title = $row_edit['title'];
         $price = $row_edit['price'];
         $img1 = $row_edit['img1'];
         $phone = $_SESSION['phone'];

         // Insert the product into the cart
         $inserted = "INSERT INTO `cart` (id, phone, title, price, img1, size, quantity) VALUES('', '$phone', '$title', '$price', '$img1', '$sizenumber', '$quantity')";
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
