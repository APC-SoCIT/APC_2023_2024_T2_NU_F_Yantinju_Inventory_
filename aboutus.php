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
    <title>About Yantinju Accessories - Yantinju Shop</title>
    <link rel="icon" href="admin_area/images/users/icon.jpg">
    <link rel="stylesheet" href="css/faqs.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-iJBICZl+QzN/VeJzONrCd1Nnl6KLx6UwZfjkJ9HQ67Z1nX97RNGHpOSR1Dg5I3bF/FzC+/sT+W01KllPHj7oYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include 'header.php'; ?>
    <!-- End Header -->

    <!-- Main Content -->
    <main class="container mx-auto my-8 px-4">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-7xl font-bold text-center mb-8 text-gray-800">Discover Yantinju Accessories</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-center justify-center">
                    <img src="images/about-me.jpg" alt="About Us" class="rounded-lg">
                </div>
                <div>
                    <p class="text-3xl leading-relaxed text-gray-700 mb-6">
                        Welcome to Yantinju Accessories, your ultimate destination for unique and stylish
                        accessories. Our collection is carefully curated to bring you the latest trends and timeless
                        classics, ensuring that there's something for everyone.
                    </p>

                    <p class="text-3xl leading-relaxed text-gray-700 mb-6">
                        At Yantinju, we believe in the power of self-expression through fashion. Each piece in our
                        collection is designed to help you showcase your individuality and elevate your style. From
                        chic earrings to elegant necklaces, every accessory tells a story and adds a touch of
                        personality to your look.
                    </p>

                    <p class="text-3xl leading-relaxed text-gray-700 mb-6">
                        Whether you're browsing our website or exploring our social media channels, you'll find
                        inspiration and ideas to enhance your wardrobe. Join us on our journey and discover the beauty
                        of self-expression with Yantinju Accessories.
                    </p>

                    <?php
                        $login = $_GET['confirm'];
                        if ($login == 'logged_in') {
                    ?>
                    <!-- Button to return to home page -->
                    <a href="index.php?confirm=logged_in" class="text-blue-500 underline hover:text-blue-700">Return to Home Page</a>
                    <?php
                        } else {
                    ?>
                    <!-- Button to return to home page -->
                    <a href="index.php?confirm=notlogged_in" class="text-blue-500 underline hover:text-blue-700">Return to Home Page</a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main Content -->

    <!-- JavaScript -->
    <script src="javascript/script3.js"></script>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- End Footer -->

</body>

</html>

<?php
} else {
    header("Location: header.php");
    exit();
}
?>
