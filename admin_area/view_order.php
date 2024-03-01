
        <div class="main-content">
        <header>
            <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title">
                <h1>Customer</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?view_order">View Order</a></li>
                    </ul>
                </p>
            </div>
            </div>
          
        </header>
        <main>
            <section>
            <h3 class="section-head"> List of Orders</h3>
           
                <div class="row" ><!-- 2 row Starts -->

                <div class="col-lg-12" ><!-- col-lg-12 Starts -->

                <div class="panel panel-default" ><!-- panel panel-default Starts -->

                <div class="panel-heading" ><!-- panel-heading Starts -->

                <h3 class="panel-title" ><!-- panel-title Starts -->

                <i class="fa-solid fa-money-bill"></i> View Order/s || <i class="fa-solid fa-eye" style="color: #594633"></i> = <b>View</b>

                </h3><!-- panel-title Ends -->


                </div><!-- panel-heading Ends -->

                <div class="panel-body" ><!-- panel-body Starts -->

                <div class="table-responsive" ><!-- table-responsive Starts -->

                <table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

                <thead>

                <tr>
                <th>#</th>
                <th>Customer ID</th>
                <th>Method</th>
                <th>Products Ordered</th>
                <th>Status</th>
                <th></th>



                </tr>

                </thead>

                <tbody>

                <?php
                    $i = 0;
                    $get_pro = "SELECT * FROM `order` WHERE status <> 'Product Delivered'";
                    $run_pro = mysqli_query($conn, $get_pro);


                    while ($row_pro = mysqli_fetch_array($run_pro)) {
                        $id = $row_pro['customer_id'];
                        $oid = $row_pro['order_id'];
                        $fname = $row_pro['fname'];
                        $lname = $row_pro['lname'];
                        $method = $row_pro['method'];
                        $noofproducts = $row_pro['total_products'];
                        $status = $row_pro['status'];
                        $i++;

                        // Your code to display or process each product goes here
                    
                ?>


                <tr>

                <td><?php echo $i; ?></td>

                <td><?php echo $id; ?></td>

                <td><?php echo $method; ?></td>

                <td><?php echo $noofproducts; ?></td>

                <td><?php echo $status; ?></td>


              <!-- <td>
                <?php

               // $get_sold = "select * from pending_orders where product_id='$pro_id'";
                //$run_sold = mysqli_query($con,$get_sold);
                //$count = mysqli_num_rows($run_sold);
               // echo $count;
                ?>
                </td>-->

               

                <td>

                <a href="adminpanel.php?view_detail&detail_order=<?php echo $oid; ?>">
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

         <!-- this is your alert stock -->
         <?php
            include 'stockalert.php';
          ?>
          <!--    end of alert stock    -->