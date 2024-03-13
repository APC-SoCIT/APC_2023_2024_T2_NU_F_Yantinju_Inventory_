
        <div class="main-content">
        <header>
            <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title">
                <h1>Analytics</h1>
                <p>Display analytics about your Channel <span class="las la-chart-line"></span></p>
            </div>
            </div>
            <div class="header-action">
           <!-- <button class="btn btn-main">
                <span class="las la-video"></span>
                Upload
            </button> -->
            </div>
        </header>
        <main>
            <section>
            <h3 class="section-head">Overview</h3>
            <div class="analytics">
                <div class="analytic">
                <div class="analytic-icon"><i class="fa-solid fa-money-bill-1-wave"></i></div>
                <div class="analytic-info">

                <?php
                $today = date('Y-m-d');
                $today2 = date('M j, Y'); 
                $today3 = date('F');

                $get_pro = "SELECT SUM(kinita) as daily_income
                            FROM `sales` 
                            WHERE Date(DateTime) = '$today'";
                $get_pro2 = "SELECT SUM(total_price) as pending_income
                            FROM `order` 
                            WHERE status <> 'Product Delivered'";
                            
                $run_pro = mysqli_query($conn, $get_pro);
                $run_pro2 = mysqli_query($conn, $get_pro2);

                $TotalIncome = 0;
                $pending_income = 0;

                // Fetch data and populate the array
                while ($row = mysqli_fetch_assoc($run_pro)) {
                    $dailyIncome = $row['daily_income'];
                    $TotalIncome += $dailyIncome;
                }
                // Fetch data and populate the array
                while ($row2 = mysqli_fetch_assoc($run_pro2)) {
                    $pendingIncome = $row2['pending_income'];
                    $pending_income += $pendingIncome;
                }
                ?>
                    <h4>Daily Sales <br><small class="text-success">As of <?php echo $today2 ?></small></h4>
                    <h1>₱<?php echo number_format($TotalIncome, 2); ?></h1>
                
                </div>
                </div>
           
                <!-- Monthly Sales report  -->
                <div class="analytic">
                    <div class="analytic-icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                    <div class="analytic-info">
                        <?php
                        $current_date = date("Y-m-d");
                        $month_start_date = date('Y-m-01', strtotime($current_date));
                        $month_end_date = date('Y-m-t', strtotime($current_date));

                        $get_monthly_sales = "SELECT DATE(DateTime) as monthly, SUM(kinita) as total_sales 
                                            FROM `sales` 
                                            WHERE DateTime BETWEEN '$month_start_date' AND '$month_end_date' 
                                            GROUP BY MONTH(monthly)";

                        $run_monthly_sales_query = $conn->query($get_monthly_sales);

                        // Step 3: Process the retrieved data
                        $monthly_sales = array();
                        $total_monthly_sales = 0; // Initialize total monthly sales variable

                        if ($run_monthly_sales_query->num_rows > 0) {
                            while($row = $run_monthly_sales_query->fetch_assoc()) {
                                $monthly_sales[$row['monthly']] = $row['total_sales'];
                                $total_monthly_sales += $row['total_sales']; // Accumulate total monthly sales
                            }
                        }
                        ?>
                        <h4>Monthly Sales <br><small class="text-success">As of <?php echo $today3 ?></small></h4>
                        <h1>₱<?php echo number_format($total_monthly_sales, 2); ?></h1>
                    </div>
                </div>


                <?php
                $count_users_query = "SELECT COUNT(*) as user_count FROM users WHERE role='user'";
                $count_order_query = "SELECT COUNT(*) as order_count FROM `order` WHERE status <> 'Product Delivered'";
                $count_order2_query = "SELECT COUNT(*) as order_count FROM `complete_order` WHERE status = 'Product Delivered' AND DateTime BETWEEN '$month_start_date' AND '$month_end_date'";
                $count_product_query = "SELECT COUNT(*) as product_count FROM paninda WHERE status='Available'";
                $count_ratings = "SELECT SUM(rating) as stars FROM ratings";
                $count_ratings2 = "SELECT COUNT(*) as stars FROM ratings";
                $count_page_view = "SELECT page_url, SUM(count) AS view_count FROM page_views"; 
                $run_query = mysqli_query($conn, $count_users_query);
                $run_query2 = mysqli_query($conn, $count_order_query);
                $run_query25 = mysqli_query($conn, $count_order2_query);
                $run_query3 = mysqli_query($conn, $count_page_view);
                $run_query4 = mysqli_query($conn, $count_product_query);
                $run_query5 = mysqli_query($conn, $count_ratings);
                $run_query52 = mysqli_query($conn, $count_ratings2);

                    $result = mysqli_fetch_assoc($run_query);
                    $result2 = mysqli_fetch_assoc($run_query2);
                    $result25 = mysqli_fetch_assoc($run_query25);
                    $result3 = mysqli_fetch_assoc($run_query3);
                    $result4 = mysqli_fetch_assoc($run_query4);
                    $result5 = mysqli_fetch_assoc($run_query5);
                    $result52 = mysqli_fetch_assoc($run_query52);
                    $user_count = $result['user_count'];
                    $order_count = $result2['order_count'];
                    $order_count2 = $result25['order_count'];
                    $view_count = $result3['view_count'];
                    $product_count = $result4['product_count'];
                    $product_rate = $result5['stars'] / $result52['stars'] ;

                    // Get the current month
                    $currentMonth = date('Y-m');

                    // Fetch data from the database for the current month
                    $sql = "SELECT * FROM `paninda`";
                    $result = mysqli_query($conn, $sql);

                    // Initialize an array to store product details along with quantity sold
                    $products_sold = array();

                    // Loop through the fetched rows to store product details
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Retrieve total sold products for the current month
                        $sql2 = "SELECT total_products FROM `order` WHERE status='Product Delivered' AND DATE_FORMAT(`DateTime`, '%Y-%m') = '$currentMonth'";
                        $result2 = mysqli_query($conn, $sql2);
                        $total_sold_products = 0;
                        if ($result2) {
                            // Initialize an array to store product quantities
                            $productQuantities = array();

                            // Loop through the results
                            while ($row_pro2 = mysqli_fetch_assoc($result2)) {
                                // Split the total_products string into individual products
                                $products = explode(',', $row_pro2['total_products']);

                                // Loop through each product
                                foreach ($products as $product) {
                                    // Extract quantity from the product string
                                    preg_match('/\((\d+)\)/', $product, $matches);
                                    $quantity = isset($matches[1]) ? $matches[1] : 0;

                                    // Extract product name from the product string
                                    $productName = trim(preg_replace('/\(\d+\)/', '', $product));

                                    // Add quantity to array using product name as key
                                    if (!isset($productQuantities[$productName])) {
                                        $productQuantities[$productName] = 0;
                                    }
                                    $productQuantities[$productName] += $quantity;
                                }
                            }

                            // Get total quantity for the current product
                            $productName = $row['title'];
                            $total_sold_products = isset($productQuantities[$productName]) ? $productQuantities[$productName] : 0;
                        }

                        // Retrieve the price of the product from your database
                        $product_price = $row['price'];

                        // Calculate sales per product
                        $sales_per_product = $total_sold_products * $product_price;

                        // Add product details along with quantity sold to the array
                        $products_sold[] = array(
                            'id' => $row['id'],
                            'title' => $row['title'],
                            'img1' => $row['img1'],
                            'category' => $row['category'],
                            'sales_per_product' => $sales_per_product,
                            'total_sold_products' => $total_sold_products
                        );
                    }

                    // Sort the products based on the quantity sold (total_sold_products) in descending order
                    usort($products_sold, function ($a, $b) {
                        return $b['total_sold_products'] - $a['total_sold_products'];
                    });

                    $top_product = $products_sold[0];


                ?>

                
           <div class="analytic">
                <div class="analytic-icon"><i class="fa-solid fa-eye"></i></div>
                <div class="analytic-info">
                    <h4>Page Views</h4>
                    <h1><?php echo $view_count; ?> <!--<small class="text-danger">5%</small>--></h1>
                </div>
                </div>
                <div class="analytic">
                <div class="analytic-icon"><i class="fa-solid fa-star"></i></div>
                <div class="analytic-info">
                    <h4>Avg Rating</h4>
                    <h1><?php echo number_format($product_rate,1); ?></h1>
                </div>
                </div>
                <div class="analytic">
                <div class="analytic-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                <div class="analytic-info">
                    <h4><b><?php echo $product_count; ?></b> Total<br> Products</h4>
                </div>
                </div>
                <div class="analytic">
                <div class="analytic-icon"><i class="fa-solid fa-check"></i></div>
                <div class="analytic-info">
                    <h4><b><?php echo $order_count2; ?></b> Completed Order/s</h4>
                </div>
                </div>
                
                <div class="analytic">
                    <div class="analytic-icon"><span class="las la-heart"></span></div>
                    <div class="analytic-info">
                        <?php if ($top_product['total_sold_products'] > 0): ?>
                        <a href="adminpanel.php?topproduct_report">
                            <h4>Top Product <br><small class="text-success">As of <?php echo $today3 ?></small></h4>
                            <h1><?php echo $top_product['id']; ?></h1></a>
                        <?php else: ?>
                            <h4>Top Product <br><small class="text-success">As of <?php echo $today3 ?></small></h4>
                            <h1>----</h1>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="analytic">
                <div class="analytic-icon"><i class="fa-solid fa-people-group"></i></div>
                <div class="analytic-info">
                    <a href="adminpanel.php?view_customer">
                    <h4><b><?php echo $user_count; ?></b> Total Users<br> Registered</h4></a>
                </div>
                </div>
            </div>
            </section>
            <section>
            <div class="block-grid">
                <div class="revenue-card">
                <h3 class="section-head">Total Revenue</h3>
                <div class="rev-content">
                    <img src="images/users/logo.jpg" alt="profile" style="width: 100px; height: 100px; display: block; margin: 23px auto;">
                    <div class="rev-info">
                    <h3>Yaninju Accessories </h3>
                    <h1><b><?php echo $order_count; ?> <small>Orders waiting</small></b></h1>
                    </div>
                    <div class="rev-sum">
                    <h4>Pending Sales</h4>
                    <h2>₱<?php echo number_format($pending_income, 2); ?></h2>
                    </div>
                </div>
                </div>

                <div class="graph-card">
                    <h3 class="section-head">Graph</h3>
                    <div class="graph-content">
                        <div class="graph-head">
                            <div class="icon-wrapper">
                                <div class="icon"><i class="fa-solid fa-money-bill"></i></div>
                                <div class="icon"><i class="fa-solid fa-coins"></i></div>
                            </div>
                            <div class="graph-select">
                                <select name="month" id="monthSelect">
                                    <?php
                                    // Get the current month
                                    $currentMonth = date("n");

                                    // Array of months
                                    $months = array(
                                        1 => "January",
                                        2 => "February",
                                        3 => "March",
                                        4 => "April",
                                        5 => "May",
                                        6 => "June",
                                        7 => "July",
                                        8 => "August",
                                        9 => "September",
                                        10 => "October",
                                        11 => "November",
                                        12 => "December"
                                    );

                                    // Loop through the months and create <option> tags
                                    foreach ($months as $key => $value) {
                                        // Check if the current month matches the loop iteration
                                        if ($key == $currentMonth) {
                                            // Add the selected attribute if it matches
                                            echo "<option value='$key' selected>$value</option>";
                                        } else {
                                            // Otherwise, just output the <option> tag without the selected attribute
                                            echo "<option value='$key'>$value</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="graph-board">
                            <canvas id="revenueChart" width="100%"></canvas>
                        </div>
                    </div>
                </div>

            </div>
            </section>

    
            <section>
            <h3 class="section-head"> List of Completed Orders</h3>
           
                <div class="row" ><!-- 2 row Starts -->

                <div class="col-lg-12" ><!-- col-lg-12 Starts -->

                <div class="panel panel-default" ><!-- panel panel-default Starts -->

                <div class="panel-heading" ><!-- panel-heading Starts -->

                <h3 class="panel-title" ><!-- panel-title Starts -->

                <i class="fa-solid fa-money-bill"></i> View Completed Order/s || <i class="fa-solid fa-eye" style="color: #594633"></i> = <b>View</b>

                </h3><!-- panel-title Ends -->


                </div><!-- panel-heading Ends -->

                <div class="panel-body" ><!-- panel-body Starts -->

                <div class="table-responsive" ><!-- table-responsive Starts -->

                <table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

                <thead>

                <tr>
                <th>#</th>
                <th>Order ID</th>
                <th style="width: 8rem;">Ordered By</th>
                <th>Products Ordered</th>
                <th style="width: 7rem;">Revenue</th>
                <th></th>



                </tr>

                </thead>

                <tbody>

                <?php
                    $i = 0;
                    $get_pro = "SELECT * FROM `complete_order` WHERE status = 'Product Delivered' AND DateTime BETWEEN '$month_start_date' AND '$month_end_date'";
                    $run_pro = mysqli_query($conn, $get_pro);


                    while ($row_pro = mysqli_fetch_array($run_pro)) {
                        $id = $row_pro['customer_id'];
                        $oid = $row_pro['order_id'];
                        $fname = $row_pro['fname'];
                        $lname = $row_pro['lname'];
                        $method = $row_pro['method'];
                        $noofproducts = $row_pro['total_products'];
                        $total_price = $row_pro['total_price'];
                        $i++;

                        // Your code to display or process each product goes here
                    
                ?>


                <tr>

                <td><?php echo $i; ?></td>

                <td><?php echo $oid; ?></td>

                <td><?php echo $fname; ?> <?php echo $lname; ?></td>

                <td><?php echo $noofproducts; ?></td>

                <td>
                    <span style="float: left;">₱</span><span style="float: right;"><?php echo number_format($total_price,2); ?></span>
                </td>


              <!-- <td>
                <?php

               // $get_sold = "select * from pending_orders where product_id='$pro_id'";
                //$run_sold = mysqli_query($con,$get_sold);
                //$count = mysqli_num_rows($run_sold);
               // echo $count;
                ?>
                </td>-->

               

                <td>

                <a href="adminpanel.php?view_complete_detail&detail_order=<?php echo $oid; ?>">
                <i class="fa-solid fa-eye" style="color: #594633"></i>

                </a>

                </td>


                </tr>

                <?php
                }
                    ?>
                </tbody>


                </table><!-- table table-bordered table-hover table-striped Ends -->

                </div><!-- table-responsive Ends -->

                </div><!-- panel-body Ends -->

                </div><!-- panel panel-default Ends -->

                </div><!-- col-lg-12 Ends -->

                </div><!-- 2 row Ends -->




            </section>
        </main>
        </div>

        <script src = "js/script4.js"></script>
        <script src = "js/script3.js"></script>
        <script src = "js/script2.js"></script>
        
          <!-- this is your alert stock -->
          <?php
            include 'stockalert.php';
          ?>
          <!--    end of alert stock    -->