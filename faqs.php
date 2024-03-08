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
     <!-- tailwind css library -->
     <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
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
                At Yantinju Accessories, we specialize in offering a stunning collection of necklaces, rings, earrings, pendants, and bracelets. Each piece is carefully crafted to bring elegance and style to your wardrobe. Whether you're looking for a statement necklace, a delicate pendant, or a timeless pair of earrings, we have something to suit every taste and occasion. Explore our selection and discover the perfect accessory to complement your unique style.
                </p>
                </div>

                <button class="acc-btn">
                How can I contact your business?
                </button>
                <div class="acc-content">
                <p>
                You can reach us directly by contacting our Yantinju Accessories Admin at the following number: +63 9288148208. Whether you have questions about our products, need assistance with an order, or have any other inquiries, our team is here to help.
                </p>
                </div>

                <button class="acc-btn">
                What are your business hours?
                </button>
                <div class="acc-content">
                <p>
                Our website is accessible 24/7, giving you the convenience to browse and make purchases at any time. However, our customer support and assistance are available from 8:00 am to 5:00 pm every day.
                </p>
                </div>

                <button class="acc-btn">
                How can I track my order?
                </button>
                <div class="acc-content">
                <p>
                To track your order, simply navigate to the 'Orders' section in your profile. There, you'll find an order tracking feature where you can check the status of your purchase. It'll provide you with real-time updates on the progress of your order.
                </p>
                </div>

                <button class="acc-btn">
                What payment methods do you accept?
                </button>
                <div class="acc-content">
                <p>
                At the moment, we only accept Cash on Delivery (COD) as our payment method. This means you can pay for your order in cash when it's delivered to your doorstep. We're constantly evaluating new payment options to enhance your shopping experience.
                </p>
                </div>

                <button class="acc-btn">
                Do you have a physical store?
                </button>
                <div class="acc-content">
                <p>
                Not at the moment. We're currently exclusively online. However, we're always looking into expanding, so keep an eye out for any updates.
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