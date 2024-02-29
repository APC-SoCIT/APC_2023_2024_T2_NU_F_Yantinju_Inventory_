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
    <title>Admin Panel - Yantinju Shop</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="images/users/icon.jpg">
     <!-- tailwind css library -->
     <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
    <!-- Line awesome icon library -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
   <!-- chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <!-- font awesome icons library-->
    <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
     <!-- Intitialize SweetAlert-->
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
    
</head>
<body>
    <input type="checkbox" name="" id="menu-toggle">
    <div class="overlay"><label for="menu-toggle"></label></div>
    <!-- this is your navbar -->
    <?php include 'header2.php'; ?>
    <!-- end of navbar -->
    <?php
    if(isset($_GET['dashboard'])){
        include("dashboard.php");
    }
    if(isset($_GET['products2'])) {
        include("products2.php");
    }
    if(isset($_GET['edit_product'])){
        include("edit_product.php");
    }    
    if(isset($_GET['view_customer'])){
        include("view_customer.php");
    }
    if(isset($_GET['insert_admin'])){
        include("insert_admin.php");
    }
    if(isset($_GET['insert_products'])){
        include("insert_products.php");
    }
    if(isset($_GET['view_order'])){
        include("view_order.php");
    }
    if(isset($_GET['view_detail'])){
        include("view_detail.php");
    }
    if(isset($_GET['report'])){
        include("report.php");
    }
    if(isset($_GET['sales_report'])){
        include("monthsales_report.php");
    }
    if(isset($_GET['numusers_report'])){
        include("numusers_report.php");
    }
    if(isset($_GET['topproduct_report'])){
        include("topproduct_report.php");
    }
    if(isset($_GET['logout'])){
        include("capstone/logout.php");
    }
    ?>
</body>
</html>


<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>