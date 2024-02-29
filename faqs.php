<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

    // Get the current page URL
    $page_url = $_SERVER['REQUEST_URI'];

    // Insert the page view into the database
    $sql = "INSERT INTO page_views (page_url) VALUES ('$page_url')";
    mysqli_query($conn, $sql);
  
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs Page - Yantinju Shop</title>
    <link rel="icon" href="admin_area/images/users/icon.jpg">
    <link rel="stylesheet" href="css/faqs.css">

    <!-- css library bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- js library bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- font awesome icons library-->
    <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
    <!-- IonIcons library -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</head>
<body>

    
        <!-- this is your header -->
        <?php
            include 'header.php';
        ?>

        <!--    end of header    -->

        <main class="card">
            

            <h2 class="title">FAQ/s</h2>

            <div class="acc-container">

                <button class="acc-btn">What products or services do you offer?</button>
                <div class="acc-content">
                <p>
                Provide a brief overview of the products or services your business offers.
                </p>
                </div>

                <button class="acc-btn">
                How can I contact your business?
                </button>
                <div class="acc-content">
                <p>
                Include information on phone numbers, email addresses, physical addresses, and any social media profiles.
                </p>
                </div>

                <button class="acc-btn">
                What are your business hours?
                </button>
                <div class="acc-content">
                <p>
                Specify the days and hours your business is open.
                </p>
                </div>

                <button class="acc-btn">
                Do you offer online ordering or services?
                </button>
                <div class="acc-content">
                <p>
                Provide information on any online platforms or services your business offers.
                </p>
                </div>

                <button class="acc-btn">
                What is your return/exchange policy?
                </button>
                <div class="acc-content">
                <p>
                Outline the terms and conditions for returns or exchanges, including any time limits or conditions.
                </p>
                </div>

                <button class="acc-btn">
                How can I track my order?
                </button>
                <div class="acc-content">
                <p>
                If applicable, provide information on how customers can track their orders.
                </p>
                </div>

                <button class="acc-btn">
                What payment methods do you accept?
                </button>
                <div class="acc-content">
                <p>
                List the types of payment your business accepts, such as credit cards, cash, or online payment platforms.
                </p>
                </div>

                <button class="acc-btn">
                Do you have a physical store?
                </button>
                <div class="acc-content">
                <p>
                If you have a physical location, provide the address and any relevant details.
                </p>
                </div>

            </div>
            </main>

            <script src = "javascript/script3.js"></script>

            <?php
            include 'footer.php';
            ?>

</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>