

        <div class="main-content">
        <header>
            <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title ">
                <h1>Customer</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?view_order">View Order</a></li>
                        <li>Order Details</li>
                    </ul>
                </p>
            </div>
            
        </header>
        <main>
            <section>

            <?php

            $view_id = $_GET['detail_order'];

            $get_pro2 = "SELECT * FROM `order` WHERE order_id='$view_id'";
            $run_pro2 = mysqli_query($conn, $get_pro2);

            $row_pro2 = mysqli_fetch_array($run_pro2);
                $cid = $row_pro2['customer_id'];
                $oid = $row_pro2['order_id'];
                $fname = $row_pro2['fname'];
                $lname = $row_pro2['lname'];
                $email = $row_pro2['email'];
                $address = $row_pro2['address'];
                $province = $row_pro2['province'];
                $city = $row_pro2['city'];
                $brgy = $row_pro2['brgy'];
                $pin = $row_pro2['pin_code'];
                $method = $row_pro2['method'];
                $price = $row_pro2['total_price'];
                $vat = $row_pro2['tax'];
                $status = $row_pro2['status'];
                $DateTime = $row_pro2['DateTime'];
                $totalPrice = $price - 50 - $vat;

            ?>

            <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
                <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

                <div class="flex justify-start item-start space-y-2 flex-col">
                    <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Order #<?php echo $oid ?></h1>
                    <p class="text-base dark:text-gray-300 font-medium leading-6 text-gray-600"><?php echo $DateTime ?></p>
                </div>
                <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                    <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                    <div class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                        <p class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">Customer’s Cart</p>
                        
                        <?php
                        $products = explode(',', $row_pro2['total_products']);

                        foreach ($products as $product) {
                            // Extract item_name, item_size, and quantity directly in the if condition
                            if (preg_match('/^(.*?) \(size (\d+)\) \((\d+)\)$/', trim($product, " \t\n\r\0\x0B("), $matches)) {
                                $item_name = trim($matches[1]); // Get the item name
                                $item_size = (int)$matches[2];  // Get the item size
                                $quantity = (int)$matches[3];   // Get the quantity
                        
                                // Fetch image URL based on the product name
                                $query = "SELECT img1, price FROM paninda WHERE title = '$item_name'";
                                $result = mysqli_query($conn, $query);
                                
                                $row = mysqli_fetch_assoc($result);
                                $image_url = $row['img1']; 
                                $price2 = $row['price']; 
                        
                                $totall = $price2 * $quantity;
                            ?>

        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
            <div class="pb-4 md:pb-8 w-full md:w-40">
                <img src="images/products/<?php echo $image_url; ?>" style="max-width: 100px; max-height: 100px;">
            </div>
            <div class="border-b border-gray-300 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                <div class="w-full flex flex-col justify-start items-start space-y-8">
                    <h3 class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800"><?php echo $item_name ?> <br> size <?php echo $item_size ?></h3>
                </div>
                <div class="flex justify-between space-x-8 items-start w-full">
                    <p class="text-base dark:text-white xl:text-lg leading-6">₱ <?php echo $price2; ?></p>
                    <p class="text-base dark:text-white xl:text-lg leading-6 text-gray-800">+<?php echo $quantity; ?></p>
                    <p class="text-base dark:text-white xl:text-lg font-semibold leading-6">₱ <?php echo number_format($totall,2); ?></p>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

                    </div>
                    <div class="flex justify-center flex-col md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                        <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                        <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Summary</h3>
                        <div class="flex justify-center items-center w-full space-y-4 flex-col border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Subtotal</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">₱<?php echo number_format($totalPrice,2) ?></p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">VAT 12%</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">₱<?php echo number_format($vat,2) ?></p>
                            </div>
                            <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Shipping</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">₱50.00</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white font-semibold leading-4 text-gray-800">Total</p>
                            <p class="text-base dark:text-gray-300 font-semibold leading-4 text-gray-600">₱<?php echo number_format($price,2)?></p>
                        </div>
                        </div>
                        <div class="flex flex-col justify-center px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                        <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Order Status</h3>
                        <div class="flex justify-between items-start w-full">
                            <div class="flex justify-center items-center space-x-4">
                            <div class="flex flex-col justify-start items-center">
                            <form  method="post" href="">
                            <select name="stats" class="form-control" >

                                <option> <?php echo $status ?> </option>

                                    <?php
                                        $get_cat = "SELECT * FROM statusDelivery";
                                        $run_cat = mysqli_query($conn, $get_cat);
                                        while ($row_cat = mysqli_fetch_array($run_cat)) {
                                            $id = $row_cat['id'];
                                            $stats = $row_cat['status'];
                                            echo "<option>$stats</option>";
                                        }
                                        ?>

                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="w-full flex justify-center items-center">
                            <button id="changeButton" class="hover:bg-black dark:bg-white dark:text-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 py-5 w-96 md:w-full bg-gray-800 text-base font-medium leading-4 text-white" name="change">Change</button>
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Customer</h3>
                    <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                        <div class="flex flex-col justify-start items-start flex-shrink-0">
                        <div class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200">
                        <?php
                        $get_pro2 = "SELECT profilepic FROM users WHERE customer_id='$cid'";
                        $run_pro2 = mysqli_query($conn, $get_pro2);

                        $row_pro2 = mysqli_fetch_array($run_pro2);
                        $pp = $row_pro2['profilepic'];
                        ?>
                            <img src="images/users/<?php echo $pp?>" alt="avatar"  width="50%" height="50%" />
                            <div class="flex justify-start items-start flex-col space-y-2">
                            <p class="text-base dark:text-white font-semibold leading-4 text-left text-gray-800"><?php echo $fname ?> <?php echo $lname ?></p>
                            <p class="text-sm dark:text-gray-300 leading-5 text-gray-600">10 Previous Orders</p>
                            </div>
                        </div>

                        <div class="flex justify-center text-gray-800 dark:text-white md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 7L12 13L21 7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="cursor-pointer text-sm leading-5 "><?php echo $email ?></p>
                        </div>
                        </div>
                        <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                        <div class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start">
                            <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8">
                            <p class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800">Shipping Address</p>
                            <p class="w-48 lg:w-full dark:text-gray-300 xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600"><?php echo $address?>, <?php echo $brgy?>  <?php echo $city?>, <?php echo $province?> <?php echo $pin?></p>
                            </div>
                            <div class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4">
                            <p class="text-base dark:text-white font-semibold leading-4 text-center md:text-left text-gray-800">Billing Address</p>
                            <p class="w-48 lg:w-full dark:text-gray-300 xl:w-48 text-center md:text-left text-sm leading-5 text-gray-600"><?php echo $address?>, <?php echo $brgy?>  <?php echo $city?>, <?php echo $province?> <?php echo $pin?></p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>  
                        
            </section>
        </main>
        </div>

        <script src = "javascript/script4.js"></script>


<?php

if (isset($_POST['change'])) {

    $currentDate = date("Y-m-d");

    $get_order = "SELECT * FROM `order` WHERE order_id='$view_id'";
    $run_order2 = mysqli_query($conn, $get_order);

    $row_order2 = mysqli_fetch_array($run_order2);
    $customer_id = $row_order2['customer_id'];
    $order_id = $row_order2['order_id'];
    $fname = $row_order2['fname'];
    $lname = $row_order2['lname'];
    $number = $row_order2['number'];
    $email = $row_order2['email'];
    $method = $row_order2['method'];
    $address = $row_order2['address'];
    $province = $row_order2['province'];
    $city = $row_order2['city'];
    $brgy = $row_order2['brgy'];
    $pin_code = $row_order2['pin_code'];
    $total_product = $row_order2['total_products'];
    $final_amount = $row_order2['total_price'];
    $with_vat = $row_order2['tax'];
    $status = 'Product Delivered';
    $DateTime = $row_order2['DateTime'];

    $product_stats = $_POST['stats'];

    $update_stats = "UPDATE `order` SET status = '$product_stats' WHERE order_id = '$order_id'";

    $run_stats = mysqli_query($conn, $update_stats);

    $transfer_query = "INSERT INTO `complete_order`(id, customer_id, order_id, fname, lname, number, email, method, address, province, city, brgy, pin_code, total_products, total_price, tax, status, DateTime) VALUES('', '$customer_id', '$order_id', '$fname', '$lname', '$number','$email','$method','$address','$province','$city','$brgy','$pin_code','$total_product','$final_amount', '$with_vat', '$status', '$DateTime')";

    mysqli_query($conn, $transfer_query);

    if ($product_stats == "Product Delivered") {
        $sales_info = mysqli_query($conn, "SELECT * FROM `order` WHERE order_id = '$no' AND status='Product Delivered'");
        $row_sales = mysqli_fetch_array($sales_info);
    
        $get_pro = $row_sales['total_price'];
        $get_date = date("Y-m-d");
    
        // Check if there's already a record for today's date
        $check_existing_sales = mysqli_query($conn, "SELECT * FROM `sales` WHERE DateTime = '$get_date'");
        if (mysqli_num_rows($check_existing_sales) > 0) {
            // Update the existing record
            $update_sales_query = "UPDATE `sales` SET kinita = kinita + '$get_pro' WHERE DateTime = '$get_date'";
            mysqli_query($conn, $update_sales_query);
        } else {
            // Insert a new record
            $insert_order = "INSERT INTO `sales` (kinita, DateTime) VALUES ('$get_pro', '$get_date')";
            mysqli_query($conn, $insert_order);
        }
    }
    

    if ($run_stats) {
        echo "<script>window.open('adminpanel.php?view_order','_self')</script>";
    }
}
  
?>
