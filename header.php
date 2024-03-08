<?php

if(isset($_GET['confirm'])) {
$login = $_GET['confirm'];


if($login == 'notlogged_in') {
?>
<section class="top-txt">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <div class="head-txt">
                    <p>No account yet? Sign up now.</p>
                </div>
            </div>
            <div class="col-xs-6 text-right">
                <div class="sing_in_up">
                    <a href="signup.php">SIGN UP</a>
                </div>
            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-default" style=" margin-bottom: 0px; font-family: 'Poppins', sans-serif;">
    <div class="container-fluid">
        <!-- Navbar content here -->
        <div class="navbar-header">
            <!-- Navbar toggle button (for mobile) -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Your logo or brand here -->
            <a class="navbar-brand" href="#"><img src="images/icon.png" style="max-width: 50px; max-height: 50px; margin-top: -1.5rem;"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <!-- Navbar links -->
            <ul class="nav navbar-nav">
                <li><a href="index.php?confirm=notlogged_in">Home</a></li>
                <li><a href="products.php?confirm=notlogged_in">Products</a></li>
                <li><a href="faqs.php?confirm=notlogged_in">FAQs</a></li>
                <li><a href="aboutus.php?confirm=notlogged_in">About Us</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right" style="margin-right: 3rem">
                <li><a href="#">Cart</a></li>
                <li><a href="login2.php">Log In</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php
} else {
?>

<nav class="navbar navbar-default" style=" margin-bottom: 0px; font-family: 'Poppins', sans-serif;">
    <div class="container-fluid">
        <!-- Navbar content here -->
        <div class="navbar-header">
            <!-- Navbar toggle button (for mobile) -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Your logo or brand here -->
            <a class="navbar-brand" href="#"><img src="images/icon.png" style="max-width: 50px; max-height: 50px; margin-top: -1.5rem;"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <!-- Navbar links -->
            <ul class="nav navbar-nav">
                <li><a href="index.php?confirm=logged_in">Home</a></li>
                <li><a href="products.php?confirm=logged_in">Products</a></li>
                <li><a href="faqs.php?confirm=logged_in">FAQs</a></li>
                <li><a href="aboutus.php?confirm=logged_in">About Us</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right" style="margin-right: 3rem">
                <li><a href="cart.php?confirm=logged_in">
                    <?php 
                        $itemCount = items();        
                        echo "<i class='fa-solid fa-cart-shopping'></i> " . $itemCount . " " . ($itemCount > 1 ? "items" : "item");
                    ?>
                </a></li>
                <li><a href="account.php?my_orders&confirm=logged_in"><i class="fa-regular fa-user"></i> <?php echo $_SESSION['fname']; ?></a></li>
            </ul>

        </div>
    </div>
</nav>
<?php
}
?>
<section> </section>
<?php 
}

    function items() {
        global $conn;

        $phone = mysqli_real_escape_string($conn, $_SESSION['phone']);

        $get_items = "SELECT * FROM `cart` WHERE phone='$phone'";
        $run_items = mysqli_query($conn, $get_items);
        $count_items = mysqli_num_rows($run_items);

        return $count_items;
    }

    ?>