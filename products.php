<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page - Yantinju Shop</title>
    <link rel="icon" href="admin_area/images/users/icon.jpg">
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/itemdisplay.css">

    <!-- css library bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- js library bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- font awesome icons library-->
    <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
    <!--- Sweet Alert --->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
</head>
<body>
   
        <!-- this is your header -->
        <?php
            include 'header.php';
        ?>
        <!-- END of header -->

        <?php
       include 'sidebar2.php';

       if (isset($_GET['Necklaces'])) {
           include 'necklaces.php';
       } else if (isset($_GET['Bracelets'])) {
           include 'bracelets.php';
       } else if (isset($_GET['Rings'])) {
           include 'rings.php';
       } else if (isset($_GET['Pendants'])) {
           include 'pendants.php';
       } else if (isset($_GET['Earrings'])) {
           include 'earrings.php';
       } else if (!isset($_GET['item']) || isset($_GET['All'])) {
           include 'productcat.php';
       } else {
           include 'itemdisplay.php';
       }
       
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