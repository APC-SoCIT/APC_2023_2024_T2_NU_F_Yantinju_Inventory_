
        <input type="checkbox" name="" id="menu-toggle">
        <div class="overlay"><label for="menu-toggle">
        </label></div>

        <div class="main-content">
        <header>
            <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title">
                <h1>Products</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li>Products</li>
                    </ul>
                </p>
            </div>
            </div>
            <div class="header-action">
            
            <a class="btn btn-main" href="adminpanel.php?insert_products">
            <i class="fa-solid fa-folder-plus"></i>
                Upload Item
            </a>
            </div>
        </header>
        <main>
            <section>
            <h3 class="section-head">List of Products</h3>
           
                <div class="row" ><!-- 2 row Starts -->

                <div class="col-lg-12" ><!-- col-lg-12 Starts -->

                <div class="panel panel-default" ><!-- panel panel-default Starts -->

                <div class="panel-heading" ><!-- panel-heading Starts -->

                <h3 class="panel-title" ><!-- panel-title Starts -->

                <i class="fa-solid fa-shop"></i> View Products || <i class="fa fa-trash-o" style="color: #DC071B"> </i> = <b>Delete</b>, <i class="fa fa-pencil" style="color: #115579"> </i> = <b>Edit</b>, <i class="fa-solid fa-box-archive" style="color: #115579;"> </i> = <b>Change Status</b>

                </h3><!-- panel-title Ends -->


                </div><!-- panel-heading Ends -->

                <div class="panel-body" ><!-- panel-body Starts -->

                <div class="table-responsive" ><!-- table-responsive Starts -->

                <table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

                <thead>

                <tr>
                <th>#</th>
                <th>Product</th>
                <th>Title</th>
                <th>Categories</th>
                <th style="width: 10%">Price</th>
               <!--<th>Sold</th>-->
                <th>Status</th>
                <th>stock</th>
                <th></th>
                <th></th>
                <th></th>



                </tr>

                </thead>

                <style>
                    .disabled-row {
                        background-color: #ffcccc; /* light red background */
                    }
                </style>

                <tbody>

                <?php
                    $i = 0;
                    $get_pro = "SELECT * FROM paninda ORDER BY stock ASC";
                    $run_pro = mysqli_query($conn, $get_pro);

                    while ($row_pro = mysqli_fetch_array($run_pro)) {
                        $pro_title = $row_pro['title'];
                        $pp = $row_pro['img1'];
                        $id = $row_pro['id'];
                        $cat = $row_pro['category'];
                        $price = $row_pro['price'];
                        $stock = $row_pro['stock'];
                        $pro_desc = $row_pro['status'];
                        $i++;

                        $row_class = ($pro_desc == 'Archive') ? 'disabled-row' : '';
                ?>


                <tr class="<?php echo $row_class; ?>">

                <td><?php echo $i; ?></td>

                <td><img src="images/products/<?php echo $pp;?>" style="max-width: 100px; max-height: 100px;"></td>

                <td><?php echo $pro_title; ?> <br><b><?php echo $id; ?></br><b></td>

                <td><?php echo $cat; ?></td>

                <td>
                <span style="float: left;">₱</span><span style="float: right;"><?php echo $price; ?></span>
                </td>

              <!-- <td>
                <?php

               // $get_sold = "select * from pending_orders where product_id='$pro_id'";
                //$run_sold = mysqli_query($con,$get_sold);
                //$count = mysqli_num_rows($run_sold);
               // echo $count;
                ?>
                </td>-->

                <td> <?php echo $pro_desc; ?> </td>

                <td> <?php echo $stock; ?> </td>

               

                <td style="text-align: center;">
                    <a href="#" class="delete-product" data-product="<?php echo $pro_title; ?>">
                        <i class="fa fa-trash-o" style="color: #DC071B"></i>
                    </a>
                </td>

                <script>
                    // Assuming you've included SweetAlert script before this code

                    // Add a click event listener to all delete-product links
                    document.querySelectorAll('.delete-product').forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent the default link behavior
                            
                            const productTitle = this.dataset.product; // Get the product title from data attribute

                            // Show SweetAlert confirmation dialog
                            Swal.fire({
                                title: 'Are you sure?',
                                text: productTitle + ' will be deleted!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Delete',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to delete_product.php with product title as parameter
                                    window.location.href = 'delete_product.php?delete_product=' + encodeURIComponent(productTitle);
                                }
                            });
                        });
                    });
                </script>


                <td style="text-align: center;">

                <a href="adminpanel.php?edit_product&edit_product=<?php echo $pro_title; ?>">

                <i class="fa fa-pencil" style="color: #115579"> </i>

                </a>

                </td>

                <td style="text-align: center;">

                <a href="archive_product.php?archive_product=<?php echo $pro_title; ?>">

                <i class="fa-solid fa-box-archive" style="color: #115579;"> </i>

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