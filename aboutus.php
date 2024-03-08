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
            

            <h2 class="title">About Yantinju Accessories</h2>

            <div class="acc-container">

                <p>
                About Yantinju Accessories:

Yantinju Accessories isn't just another store – it's a testament to passion, dedication, and the power of community. Founded by a local entrepreneur with a vision, Yantinju Accessories began its journey on Shopee, offering a curated selection of accessories that spoke to individuality and style. But as the world evolved, so did Yantinju's approach. Recognizing the potential of platforms like TikTok, we made the leap, sharing our story and products with a wider audience in a way that felt personal and engaging.

From trendy earrings to statement necklaces, each piece in our collection is a reflection of our values – authenticity, creativity, and connection. We're not just here to sell accessories; we're here to inspire, to empower, and to celebrate the beauty of self-expression.
So whether you're browsing our website or scrolling through our TikTok feed, know that you're not just shopping for accessories – you're joining a community. Welcome to Yantinju Accessories, where style meets substance, and every accessory tells a story.
                </p>
               

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
     header("Location: header.php");
     exit();
}
 ?>