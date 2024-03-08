<?php 
session_start();
include "db_conn.php";

$login = $_GET['confirm'];
if ($login == 'logged_in') {


     // Get the current page URL
     $page_url = $_SERVER['REQUEST_URI'];
     $current_date = date('Y-m-d');

     // Check if the page URL already exists in the database
     $check_query = "SELECT * FROM page_views WHERE page_url = '$page_url'";
     $result = mysqli_query($conn, $check_query);
 
     // If the page URL exists, update the count; otherwise, insert a new record
     if (mysqli_num_rows($result) > 0) {
         // Update the count for the existing page URL
         $update_query = "UPDATE page_views SET count = count + 1, view_date='$current_date' WHERE page_url = '$page_url'";
         mysqli_query($conn, $update_query);
     } else {
         // Insert a new record for the page URL
         $insert_query = "INSERT INTO page_views (id, page_url, count, view_date) VALUES ('', '$page_url', 1, '$current_date')";
         mysqli_query($conn, $insert_query);
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Yantinju Shop</title>
    <link rel="icon" href="admin_area/images/users/icon.jpg">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/chatbot.css">

    <!-- css library bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--- Sweet Alert --->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <!-- tailwind css library -->
     <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
   	<!-- font awesome icons library-->
    <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
    <!-- Chat bot ai lib -->
    <script src="javascript/chatbot.js" defer></script>
    <!-- temporary icons -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body>

        <!-- this is your header -->
        <?php
            include 'header.php';
        ?>
        <!--    end of navbar    -->

        <!-- This is the home section -->
        <section id="home">
        <div class="home_page ">
            <div class="home_img ">
                <img src="images/bg.png" alt="img ">
            </div>
            <div class="home_txt ">
                <p class="collectio ">SUMMER COLLECTION</p>
                <h2 style="margin-top: 10px;">#Tipid - Series<br>Collection 2024</h2>
                <div class="home_label ">
                    <p>A specialist label creating luxury essentials. <br>Ethically crafted with an unwavering<br> commitment to exceptional quality.</p>
                </div>
                <button><a href="products.php">SHOP NOW
						<i class="zmdi zmdi-arrow-right"></a></i>
					</button>
            </div>
        </div>
    </section>

    <section id="sellers">
        <div class="seller container">
            <h2>Top Sales</h2>
            
            <div class="best-seller">
            <?php
                $i = 0;
                $get_pro = "SELECT * FROM paninda ORDER BY stock ASC LIMIT 4";
                $run_pro = mysqli_query($conn, $get_pro);

                while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $pro_title = $row_pro['title'];
                    $pp = $row_pro['img1'];
                    $price = $row_pro['price'];
                    $cat = $row_pro['category'];
            ?>
                <div class="best-p1">
                    <img src="admin_area/images/products/<?php echo $pp; ?>" alt="img">
                    <div class="best-p1-txt">
                        <div class="name-of-p">
                            <p><?php echo $pro_title; ?></p>
                        </div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <div class="price">
                            ₱<?php echo $price; ?>
                            <div class="colors">
                                <i class='bx bxs-circle red'></i>
                                <i class='bx bxs-circle blue'></i>
                                <i class='bx bxs-circle white'></i>
                            </div>
                        </div>
                        <div class="add-cart">
                        <?php
<<<<<<< HEAD
                        if($login == 'notlogged_in') {
=======
                        if($login == 'notlogged_in' || !$name) {
>>>>>>> e0b13804ce943924a3a96582970b7f9a898f7839
                        ?>
                            <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=notlogged_in">buy now</a></button>
                        <?php
                        }else {
                        ?>
                            <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=logged_in">buy now</a></button>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
        <div class="seller container">
            <h2>New Arrivals</h2>
            <div class="best-seller">
            <?php
                $i = 0;
                $get_pro = "SELECT * FROM paninda ORDER BY Date ASC LIMIT 4";
                $run_pro = mysqli_query($conn, $get_pro);

                while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $pro_title = $row_pro['title'];
                    $pp = $row_pro['img1'];
                    $price = $row_pro['price'];
                    $cat = $row_pro['category'];
            ?>
                <div class="best-p1">
                    <img src="admin_area/images/products/<?php echo $pp; ?>" alt="img">
                    <div class="best-p1-txt">
                        <div class="name-of-p">
                            <p><?php echo $pro_title; ?></p>
                        </div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <div class="price">
                            ₱<?php echo $price; ?>
                            <div class="colors">
                                <i class='bx bxs-circle blank'></i>
                                <i class='bx bxs-circle blue'></i>
                                <i class='bx bxs-circle brown'></i>
                            </div>
                        </div>
                        <div class="add-cart">
                        <?php
<<<<<<< HEAD
                        if($login == 'notlogged_in') {
=======
                        if($login == 'notlogged_in' || !$name) {
>>>>>>> e0b13804ce943924a3a96582970b7f9a898f7839
                        ?>
                            <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=notlogged_in">more details</a></button>
                        <?php
                        }else {
                        ?>
                            <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=logged_in">more details</a></button>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="seller container">
            <h2>Cheapest Sales</h2>
            <div class="best-seller">
            <?php
                $i = 0;
                $get_pro = "SELECT * FROM paninda ORDER BY price ASC LIMIT 4";
                $run_pro = mysqli_query($conn, $get_pro);

                while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $pro_title = $row_pro['title'];
                    $pp = $row_pro['img1'];
                    $price = $row_pro['price'];
                    $cat = $row_pro['category'];
            ?>
                <div class="best-p1">
                    <img src="admin_area/images/products/<?php echo $pp; ?>" alt="img">
                    <div class="best-p1-txt">
                        <div class="name-of-p">
                            <p><?php echo $pro_title; ?></p>
                        </div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                        </div>
                        <div class="price">
                            ₱<?php echo $price; ?>
                            <div class="colors">
                                <i class='bx bxs-circle grey'></i>
                                <i class='bx bxs-circle black'></i>
                                <i class='bx bxs-circle blue'></i>
                            </div>
                        </div>
                        <div class="buy-now">
                        <?php
<<<<<<< HEAD
                        if($login == 'notlogged_in') {
=======
                        if($login == 'notlogged_in' || !$name) {
>>>>>>> e0b13804ce943924a3a96582970b7f9a898f7839
                        ?>
                            <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=notlogged_in">add to cart</a></button>
                        <?php
                        }else {
                        ?>
                            <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=logged_in">add to cart</a></button>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </section>
    <section id="news">
        <div class="news-heading">
            <p>LATEST NEWS</p>
            <h2>Fashion New Trends</h2>
        </div>
        <div class="l-news container">
            <div class="l-news1">
                <div class="news1-img">
                    <img src="images/news1.jpg" alt="img">
                </div>
                <div class="news1-conte">
                    <div class="date-news1">
                        <p><i class='bx bxs-calendar'></i> 12 February 2024</p>
                        <h4>Beauty at your best: slay even in aesthetic style</h4>
                        <a href="https://villagepipol.com/estetik-the-growing-fashion-trend-among-younger-generation/" target="_blank">read more</a>
                    </div>
                </div>
            </div>
            <div class="l-news2">
                <div class="news2-img">
                    <img src="images/news2.jpg" alt="img">
                </div>
                <div class="news2-conte">
                    <div class="date-news2">
                        <p><i class='bx bxs-calendar'></i> 17 February 2023</p>
                        <h4>Self-esteem through fashion</h4>
                        <a href="https://institute.careerguide.com/what-effect-fashion-does-on-students/" target="_blank">read more</a>
                    </div>
                </div>
            </div>
            <div class="l-news3">
                <div class="news3-img">
                    <img src="images/news3.jpg" alt="img">
                </div>
                <div class="news3-conte">
                    <div class="date-news3">
                        <p><i class='bx bxs-calendar'></i> 26 February 2024</p>
                        <h4>Predicting the future of Fashion is never definite</h4>
                        <a href="https://www.philstar.com/lifestyle/fashion-and-beauty/2023/09/27/2296277/chatgpt-predicts-fashion-trends-20-years" target="_blank">read more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="contact container">
        <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.631662240899!2d121.05757211026794!3d14.733404873752859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0f90c93c88f%3A0xd583016368454e4e!2sNU%20FAIRVIEW!5e0!3m2!1sen!2sph!4v1709091318718!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <?php
<<<<<<< HEAD
            if($login == 'notlogged_in') {
=======
            if($login == 'notlogged_in' || !$name) {
>>>>>>> e0b13804ce943924a3a96582970b7f9a898f7839
        ?>
        <form action="#" method="POST">
            <div class="form">
                <div class="form-txt">
                    <h4>INFORMATION</h4>
                    <h1>Contact Us</h1>
                    <span>We're thrilled that you've taken the time to connect with us. At Yantinju, whether you have a question, feedback, or simply want to say hello, we're here and ready to assist you every step of the way.</span>
                    <h3>Ugong, Camarin</h3>
                    <p>1024 purok Laloma, Caloocan city<br>+63 9288148208</p>
                </div>
                <div class="form-details">
                    <input type="text" name="name" id="name" placeholder="Name" value="Name" style="color: #aaa;" readonly>
                    <input type="email" name="email" id="email" placeholder="Email" value="Email" style="color: #aaa;" readonly>
                    <textarea name="message" id="message" cols="52" rows="7" placeholder="Message" style="color: #aaa;" readonly></textarea>
                    <button>SEND MESSAGE</button>
                </div>
            </div>
        </form>
        <?php
            }else {
        ?>
        <form action="contact.php" method="POST">
            <div class="form">
                <div class="form-txt">
                    <h4>INFORMATION</h4>
                    <h1>Contact Us</h1>
                    <span>We're thrilled that you've taken the time to connect with us. At Yantinju, whether you have a question, feedback, or simply want to say hello, we're here and ready to assist you every step of the way.</span>
                    <h3>Ugong, Camarin</h3>
                    <p>1024 purok Laloma, Caloocan city<br>+63 9288148208</p>
                </div>
                <div class="form-details">
                    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $_SESSION['fname'] . ' ' . $_SESSION['fname']; ?>" required>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $_SESSION['email']?>" required>
                    <textarea name="message" id="message" cols="52" rows="7" placeholder="Message" required></textarea>
                    <button>SEND MESSAGE</button>
                </div>
            </div>
        </form>
        <?php
            }
        ?>
    </div>
    </section>

        <!-- this is your footer -->
        <?php
            include 'footer.php';
        ?>
        <!--    end of footer     -->

        <!-- this is your chatbot -->
        <?php
                
            if($login == 'logged_in' || !$name) {
            
            include 'chatbot.php';

            }else {}
        ?>
        <!--    end of chatbot    -->
</body>

</html>
<script src="javascript/chatbot.js"></script>

<?php 
} elseif ($login == 'notlogged_in') {


    // Get the current page URL
    $page_url = $_SERVER['REQUEST_URI'];
    $current_date = date('Y-m-d');

    // Check if the page URL already exists in the database
    $check_query = "SELECT * FROM page_views WHERE page_url = '$page_url'";
    $result = mysqli_query($conn, $check_query);

    // If the page URL exists, update the count; otherwise, insert a new record
    if (mysqli_num_rows($result) > 0) {
        // Update the count for the existing page URL
        $update_query = "UPDATE page_views SET count = count + 1, view_date='$current_date' WHERE page_url = '$page_url'";
        mysqli_query($conn, $update_query);
    } else {
        // Insert a new record for the page URL
        $insert_query = "INSERT INTO page_views (id, page_url, count, view_date) VALUES ('', '$page_url', 1, '$current_date')";
        mysqli_query($conn, $insert_query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page - Yantinju Shop</title>
   <link rel="icon" href="admin_area/images/users/icon.jpg">
   <link rel="stylesheet" href="css/homepage.css">
   <link rel="stylesheet" href="css/chatbot.css">

   <!-- css library bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <!--- Sweet Alert --->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- tailwind css library -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
      <!-- font awesome icons library-->
   <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
   <!-- Chat bot ai lib -->
   <script src="javascript/chatbot.js" defer></script>
   <!-- temporary icons -->
   <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body>

       <!-- this is your header -->
       <?php
           include 'header.php';
       ?>
       <!--    end of navbar    -->

       <!-- This is the home section -->
       <section id="home">
       <div class="home_page ">
           <div class="home_img ">
               <img src="images/bg.png" alt="img ">
           </div>
           <div class="home_txt ">
               <p class="collectio ">SUMMER COLLECTION</p>
               <h2 style="margin-top: 10px;">#Tipid - Series<br>Collection 2024</h2>
               <div class="home_label ">
                   <p>A specialist label creating luxury essentials. <br>Ethically crafted with an unwavering<br> commitment to exceptional quality.</p>
               </div>
               <button><a href="products.php">SHOP NOW
                       <i class="zmdi zmdi-arrow-right"></a></i>
                   </button>
           </div>
       </div>
   </section>

   <section id="sellers">
       <div class="seller container">
           <h2>Top Sales</h2>
           
           <div class="best-seller">
           <?php
               $i = 0;
               $get_pro = "SELECT * FROM paninda ORDER BY stock ASC LIMIT 4";
               $run_pro = mysqli_query($conn, $get_pro);

               while ($row_pro = mysqli_fetch_array($run_pro)) {
                   $pro_title = $row_pro['title'];
                   $pp = $row_pro['img1'];
                   $price = $row_pro['price'];
                   $cat = $row_pro['category'];
           ?>
               <div class="best-p1">
                   <img src="admin_area/images/products/<?php echo $pp; ?>" alt="img">
                   <div class="best-p1-txt">
                       <div class="name-of-p">
                           <p><?php echo $pro_title; ?></p>
                       </div>
                       <div class="rating">
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bx-star'></i>
                           <i class='bx bx-star'></i>
                       </div>
                       <div class="price">
                           ₱<?php echo $price; ?>
                           <div class="colors">
                               <i class='bx bxs-circle red'></i>
                               <i class='bx bxs-circle blue'></i>
                               <i class='bx bxs-circle white'></i>
                           </div>
                       </div>
                       <div class="add-cart">
                       <?php
                       if($login == 'notlogged_in' || !$name) {
                       ?>
                           <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=notlogged_in">buy now</a></button>
                       <?php
                       }else {
                       ?>
                           <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=logged_in">buy now</a></button>
                       <?php
                       }
                       ?>
                       </div>
                   </div>
               </div>
           <?php
               }
           ?>
           </div>
       </div>
       <div class="seller container">
           <h2>New Arrivals</h2>
           <div class="best-seller">
           <?php
               $i = 0;
               $get_pro = "SELECT * FROM paninda ORDER BY Date ASC LIMIT 4";
               $run_pro = mysqli_query($conn, $get_pro);

               while ($row_pro = mysqli_fetch_array($run_pro)) {
                   $pro_title = $row_pro['title'];
                   $pp = $row_pro['img1'];
                   $price = $row_pro['price'];
                   $cat = $row_pro['category'];
           ?>
               <div class="best-p1">
                   <img src="admin_area/images/products/<?php echo $pp; ?>" alt="img">
                   <div class="best-p1-txt">
                       <div class="name-of-p">
                           <p><?php echo $pro_title; ?></p>
                       </div>
                       <div class="rating">
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                       </div>
                       <div class="price">
                           ₱<?php echo $price; ?>
                           <div class="colors">
                               <i class='bx bxs-circle blank'></i>
                               <i class='bx bxs-circle blue'></i>
                               <i class='bx bxs-circle brown'></i>
                           </div>
                       </div>
                       <div class="add-cart">
                       <?php
                       if($login == 'notlogged_in' || !$name) {
                       ?>
                           <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=notlogged_in">more details</a></button>
                       <?php
                       }else {
                       ?>
                           <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=logged_in">more details</a></button>
                       <?php
                       }
                       ?>
                       </div>
                   </div>
               </div>
               <?php
               }
               ?>
           </div>
       </div>
       <div class="seller container">
           <h2>Cheapest Sales</h2>
           <div class="best-seller">
           <?php
               $i = 0;
               $get_pro = "SELECT * FROM paninda ORDER BY price ASC LIMIT 4";
               $run_pro = mysqli_query($conn, $get_pro);

               while ($row_pro = mysqli_fetch_array($run_pro)) {
                   $pro_title = $row_pro['title'];
                   $pp = $row_pro['img1'];
                   $price = $row_pro['price'];
                   $cat = $row_pro['category'];
           ?>
               <div class="best-p1">
                   <img src="admin_area/images/products/<?php echo $pp; ?>" alt="img">
                   <div class="best-p1-txt">
                       <div class="name-of-p">
                           <p><?php echo $pro_title; ?></p>
                       </div>
                       <div class="rating">
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                           <i class='bx bxs-star'></i>
                       </div>
                       <div class="price">
                           ₱<?php echo $price; ?>
                           <div class="colors">
                               <i class='bx bxs-circle grey'></i>
                               <i class='bx bxs-circle black'></i>
                               <i class='bx bxs-circle blue'></i>
                           </div>
                       </div>
                       <div class="buy-now">
                       <?php
                       if($login == 'notlogged_in' || !$name) {
                       ?>
                           <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=notlogged_in">add to cart</a></button>
                       <?php
                       }else {
                       ?>
                           <button><a href="products.php?item&products=<?php echo $pro_title; ?>&confirm=logged_in">add to cart</a></button>
                       <?php
                       }
                       ?>
                       </div>
                   </div>
               </div>
           <?php
           }
           ?>
           </div>
       </div>
   </section>
   <section id="news">
       <div class="news-heading">
           <p>LATEST NEWS</p>
           <h2>Fashion New Trends</h2>
       </div>
       <div class="l-news container">
           <div class="l-news1">
               <div class="news1-img">
                   <img src="images/news1.jpg" alt="img">
               </div>
               <div class="news1-conte">
                   <div class="date-news1">
                       <p><i class='bx bxs-calendar'></i> 12 February 2024</p>
                       <h4>Beauty at your best: slay even in aesthetic style</h4>
                       <a href="https://villagepipol.com/estetik-the-growing-fashion-trend-among-younger-generation/" target="_blank">read more</a>
                   </div>
               </div>
           </div>
           <div class="l-news2">
               <div class="news2-img">
                   <img src="images/news2.jpg" alt="img">
               </div>
               <div class="news2-conte">
                   <div class="date-news2">
                       <p><i class='bx bxs-calendar'></i> 17 February 2023</p>
                       <h4>Self-esteem through fashion</h4>
                       <a href="https://institute.careerguide.com/what-effect-fashion-does-on-students/" target="_blank">read more</a>
                   </div>
               </div>
           </div>
           <div class="l-news3">
               <div class="news3-img">
                   <img src="images/news3.jpg" alt="img">
               </div>
               <div class="news3-conte">
                   <div class="date-news3">
                       <p><i class='bx bxs-calendar'></i> 26 February 2024</p>
                       <h4>Predicting the future of Fashion is never definite</h4>
                       <a href="https://www.philstar.com/lifestyle/fashion-and-beauty/2023/09/27/2296277/chatgpt-predicts-fashion-trends-20-years" target="_blank">read more</a>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <section id="contact">
       <div class="contact container">
       <div class="map">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.631662240899!2d121.05757211026794!3d14.733404873752859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0f90c93c88f%3A0xd583016368454e4e!2sNU%20FAIRVIEW!5e0!3m2!1sen!2sph!4v1709091318718!5m2!1sen!2sph"
               width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       </div>
       <?php
           if($login == 'notlogged_in' || !$name) {
       ?>
       <form action="#" method="POST">
           <div class="form">
               <div class="form-txt">
                   <h4>INFORMATION</h4>
                   <h1>Contact Us</h1>
                   <span>We're thrilled that you've taken the time to connect with us. At Yantinju, whether you have a question, feedback, or simply want to say hello, we're here and ready to assist you every step of the way.</span>
                   <h3>Ugong, Camarin</h3>
                   <p>1024 purok Laloma, Caloocan city<br>+63 9288148208</p>
               </div>
               <div class="form-details">
                   <input type="text" name="name" id="name" placeholder="Name" value="Name" style="color: #aaa;" readonly>
                   <input type="email" name="email" id="email" placeholder="Email" value="Email" style="color: #aaa;" readonly>
                   <textarea name="message" id="message" cols="52" rows="7" placeholder="Message" style="color: #aaa;" readonly></textarea>
                   <button>SEND MESSAGE</button>
               </div>
           </div>
       </form>
       <?php
           }else {
       ?>
       <form action="contact.php" method="POST">
           <div class="form">
               <div class="form-txt">
                   <h4>INFORMATION</h4>
                   <h1>Contact Us</h1>
                   <span>We're thrilled that you've taken the time to connect with us. At Yantinju, whether you have a question, feedback, or simply want to say hello, we're here and ready to assist you every step of the way.</span>
                   <h3>Ugong, Camarin</h3>
                   <p>1024 purok Laloma, Caloocan city<br>+63 9288148208</p>
               </div>
               <div class="form-details">
                   <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $_SESSION['fname'] . ' ' . $_SESSION['fname']; ?>" required>
                   <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $_SESSION['email']?>" required>
                   <textarea name="message" id="message" cols="52" rows="7" placeholder="Message" required></textarea>
                   <button>SEND MESSAGE</button>
               </div>
           </div>
       </form>
       <?php
           }
       ?>
   </div>
   </section>

       <!-- this is your footer -->
       <?php
           include 'footer.php';
       ?>
       <!--    end of footer     -->

       <!-- this is your chatbot -->
       <?php
               
<<<<<<< HEAD
           if($login == 'logged_in') {
=======
           if($login == 'logged_in' || !$name) {
>>>>>>> e0b13804ce943924a3a96582970b7f9a898f7839
           
           include 'chatbot.php';

           }else {}
       ?>
       <!--    end of chatbot    -->
</body>

</html>
<script src="javascript/chatbot.js"></script>

<?php 
}else{
     header("Location: index.php?confirm=notlogged_in");
     exit();
}
 ?>