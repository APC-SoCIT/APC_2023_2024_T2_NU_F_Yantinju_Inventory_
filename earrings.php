<div class="col-md-9">
    <section class="panel">
        <div class="panel-body">
            <div class="pull-right">
                <ul class="pagination pagination-sm pro-page-list">
                <?php
                    include('db_conn.php');

                    if($login == 'notlogged_in') {
                        // Set the number of products per page
                        $per_page = 6;

                        // Query to count the total number of available products
                        $count_query = "SELECT COUNT(*) AS total FROM paninda WHERE category='Earrings' AND status='Available'";
                        $count_result = mysqli_query($conn, $count_query);
                        $total_products = mysqli_fetch_assoc($count_result)['total'];
                        // Calculate the total number of pages
                        $total_pages = ceil($total_products / $per_page);

                        // Output pagination links
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<li><a href="?Earrings&page=' . $i . '&confirm=notlogged_in">' . $i . '</a></li>';
                        }

                    } else {
                        // Set the number of products per page
                        $per_page = 6;

                        // Query to count the total number of available products
                        $count_query = "SELECT COUNT(*) AS total FROM paninda WHERE category='Earrings' AND status='Available'";
                        $count_result = mysqli_query($conn, $count_query);
                        $total_products = mysqli_fetch_assoc($count_result)['total'];
                        // Calculate the total number of pages
                        $total_pages = ceil($total_products / $per_page);

                        // Output pagination links
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<li><a href="?Earrings&page=' . $i . '&confirm=logged_in">' . $i . '</a></li>';
                        }
                    }
                ?>
                </ul>
            </div>
        </div>
    </section>

    <div class="row product-list">
     
        <?php 
            // Get the current page number from the URL parameter, default to 1 if not set
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $per_page;

        
            $get_pro = "SELECT * FROM paninda WHERE category='Earrings' AND status='Available' LIMIT $offset, $per_page";
            $run_pro = mysqli_query($conn, $get_pro);

            while ($row = mysqli_fetch_array($run_pro)) {
                // $row contains data for each product from the database
                $productId = $row['id'];
                $productName = $row['title'];
                $productImage = $row['img1'];
                $productPrice = $row['price'];

                // Output HTML for each product
                ?>
                <?php
                $login = $_GET['confirm'];
                if($login == 'notlogged_in') {
                ?>
                <div class="col-md-4">
                        <section class="panel">
                            <div class="pro-img-box">
                            <form action="" method="post">
                                <a href="products.php?item&products=<?php echo $productName ?>&confirm=notlogged_in">
                                <img src="admin_area/images/products/<?php echo $productImage ?>" alt="" />
                                </a>
                            
                                <!-- Include SweetAlert script -->

                                <?php
                                // Check if 'success' parameter is set in URL
                                if(isset($_GET['success'])) {
                                    $success = $_GET['success'];
                                    $product = $_GET['product'];

                                    // Display SweetAlert based on success parameter
                                    if($success == 1) {
                                        ?>
                                        <script>
                                            // Display success alert
                                            Swal.fire({
                                                title: '<?php echo $product; ?> added to cart successfully',
                                                icon: 'success'
                                            });
                                        </script>
                                        <?php
                                    } elseif($success == 0) {
                                        ?>
                                        <script>
                                            // Display error alert
                                            Swal.fire({
                                                title: 'Error',
                                                text: 'Failed to add <?php echo $product; ?> to cart',
                                                icon: 'error'
                                            });
                                        </script>
                                        <?php
                                    } elseif($success == 2) {
                                        ?>
                                        <script>
                                            // Display error alert
                                            Swal.fire({
                                                title: '<?php echo $product; ?> was already added',
                                                icon: 'info'
                                            });
                                        </script>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="panel-body text-center">
                                <h4>
                                    <a href="products.php?item&products=<?php echo $productName ?>&confirm=notlogged_in" name="productName" class="pro-title"><?php echo $productName ?></a>
                                </h4>
                                <p class="price">₱  <?php echo $productPrice ?></p>
                            </form>
                            </div>
                        </section>
                    </div>
                <?php
                }else {
                ?>
                                <div class="col-md-4">
                        <section class="panel">
                            <div class="pro-img-box">
                            <form action="" method="post">
                                <a href="products.php?item&products=<?php echo $productName ?>&confirm=logged_in">
                                <img src="admin_area/images/products/<?php echo $productImage ?>" alt="" />
                                </a>
                            
                                <!-- Include SweetAlert script -->

                                <?php
                                // Check if 'success' parameter is set in URL
                                if(isset($_GET['success'])) {
                                    $success = $_GET['success'];
                                    $product = $_GET['product'];

                                    // Display SweetAlert based on success parameter
                                    if($success == 1) {
                                        ?>
                                        <script>
                                            // Display success alert
                                            Swal.fire({
                                                title: '<?php echo $product; ?> added to cart successfully',
                                                icon: 'success'
                                            });
                                        </script>
                                        <?php
                                    } elseif($success == 0) {
                                        ?>
                                        <script>
                                            // Display error alert
                                            Swal.fire({
                                                title: 'Error',
                                                text: 'Failed to add <?php echo $product; ?> to cart',
                                                icon: 'error'
                                            });
                                        </script>
                                        <?php
                                    } elseif($success == 2) {
                                        ?>
                                        <script>
                                            // Display error alert
                                            Swal.fire({
                                                title: '<?php echo $product; ?> was already added',
                                                icon: 'info'
                                            });
                                        </script>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="panel-body text-center">
                                <h4>
                                    <a href="products.php?item&products=<?php echo $productName ?>&confirm=logged_in" name="productName" class="pro-title"><?php echo $productName ?></a>
                                </h4>
                                <p class="price">₱  <?php echo $productPrice ?></p>
                            </form>
                            </div>
                        </section>
                    </div>
                <?php
                }
                ?>
            <?php

                }
        
            ?>
    </div>            
</div>
