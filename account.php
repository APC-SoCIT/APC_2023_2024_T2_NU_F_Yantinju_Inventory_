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
    <title>Settings - Yantinju Shop</title>
    <link rel="icon" href="admin_area/images/users/icon.jpg">
    
    <link rel="stylesheet" href="css/homepage.css">

    <!-- css library bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- tailwind css library -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
    
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
        <!--    end of navbar    -->
        
        
        <div id="content" ><!-- content Starts -->
        <div class="container" style="margin-top: 5rem; margin-bottom: 5rem;" ><!-- container Starts -->



        <div class="col-md-12"><!-- col-md-12 Starts -->

        <div class="col-md-3"><!-- col-md-3 Starts -->

        <?php include("sidebar.php"); ?>

        </div><!-- col-md-3 Ends -->

        <div class="col-md-9" ><!--- col-md-9 Starts -->

        <div class="box" ><!-- box Starts -->

        <?php


        if(isset($_GET['my_orders'])){

        include("my_orders.php");

        }

        if(isset($_GET['edit_profile'])) {

        include("edit_profile.php");
    
        }

        if(isset($_GET['edit_address'])) {

        include("edit_address.php");

        }

        if(isset($_GET['logout'])){

        include("logout.php");

        }

        ?>

        </div><!-- box Ends -->


        </div><!--- col-md-9 Ends -->

        </div><!-- container Ends -->
        </div><!-- content Ends -->







        <!-- this is your footer -->
        <?php
            include 'footer.php';
        ?>
<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>


</body>
</html>

<?php 
}else{
header("Location: index.php");
exit();
}
?>