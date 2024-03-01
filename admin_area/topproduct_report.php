<?php
// Include the database connection file
include "db_conn.php";

$month_of = isset($_GET['month_of']) ? $_GET['month_of'] : date('Y-m'); // Default to current month

// Fetch data from the database based on the selected month
$sql = "SELECT * FROM `paninda`";
$result = mysqli_query($conn, $sql);

// Initialize an array to store product details along with quantity sold
$products_sold = array();

// Loop through the fetched rows to store product details
while ($row = mysqli_fetch_assoc($result)) {
    // Retrieve total sold products for the selected month
    $sql2 = "SELECT total_products FROM `order` WHERE status='Product Delivered' AND DATE_FORMAT(`DateTime`, '%Y-%m') = '$month_of'";
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
        'price' => $row['price'],
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
?>


<!-- Start of HTML content -->
<input type="checkbox" name="" id="menu-toggle">
<div class="overlay"><label for="menu-toggle"></label></div>

<div class="main-content">
    <header>
        <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title">
                <h1>Best Selling Products</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?report">Report</a></li>
                        <li>Top Product Report</li>
                    </ul>
                </p>
            </div>
        </div>
    </header>
    <main>
        <section>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Top Products</h3>
                        </div>
                        <div class="panel-body">
                            <div class="btn-wrapper">
                                <!-- Filter button -->
                                <form id="filter-report" class="form-inline">
                                    <div class="form-group">
                                        <input type="month" name="month_of" class="form-control" value="<?php echo ($month_of) ?>">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-sm btn-primary" type="submit">Filter</button>
                                    </div>
                                </form>
                                <!-- Print button -->
                                <button class="btn btn-sm btn-success" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product ID</th>
                                            <th>Product name</th>
                                            <th style="width: 6rem">Price</th>
                                            <th>Sold Count</th>
                                            <th>Category</th>
                                            <th>Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($products_sold as $product) {
                                        $i++;
                                    ?>
                                    <tr <?php if ($i === 1) echo 'style="background-color: lightgreen;"'; ?>>
                                        <td><img src="images/products/<?php echo $product['img1']; ?>" style="max-width: 100px; max-height: 100px;"></td>
                                        <td><?php echo $product['id']; ?></td>
                                        <td><?php echo $product['title']; ?></td>
                                        <td><b><span style="float:left;">₱</span><span style="float:right;"><?php echo $product['price']; ?></span></b></td>
                                        <td style="text-align:center;"><b>x<?php echo $product['total_sold_products']; ?></b></td>
                                        <td><?php echo $product['category']; ?></td>
                                        <td>
                                            <span style="float: left;">₱</span><span style="float: right;"><?php echo number_format($product['sales_per_product'], 2); ?></span>
                                        </td>
                                    </tr>
                                    <?php } 
                                    ?>
                                    <?php 
                                    // Initialize total amount variable
                                    $total_amount = 0;

                                    // Loop through the products_sold array to calculate the total amount
                                    foreach ($products_sold as $product) {
                                        $total_amount += $product['sales_per_product'];
                                    }
                                    ?>
                                    <!-- Display total amount row -->
                                    <tr>   
                                        <td colspan="6" align="right">Total Amount:</td>
                                        <td>₱<?php echo number_format($total_amount,2); ?></td>
                                    </tr>
                                </tbody>

                                </table>
                            </div><!-- table-responsive Ends -->
                        </div><!-- panel-body Ends -->
                    </div><!-- panel panel-default Ends -->
                </div><!-- col-lg-12 Ends -->
            </div><!-- row Ends -->
        </section>
    </main>
</div>

<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#print').click(function(){
        var selectedMonth = $('input[name="month_of"]').val();
        var selectedMonthWord = '';
        if (selectedMonth) {
            var date = new Date(selectedMonth);
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            var monthNames = ['January 2024', 'February 2024', 'March 2024', 'April 2024', 'May 2024', 'June 2024', 'July 2024', 'August 2024', 'September 2024', 'October 2024', 'November 2024', 'December '];
            selectedMonthWord = monthNames[monthIndex];
            selectedMonth = year + '-' + selectedMonthWord;
        }
        
        var _content = $('main').clone();
        // Remove filter and print buttons
        _content.find('.btn-wrapper').remove();
        // Remove selected month
        _content.find('.selected-month').remove();
        
        var nw = window.open("","_blank","width=800,height=700");
        nw.document.write('<html><head><title>Yantinju Accessories</title><link rel="stylesheet" href="css/bootstrap.min.css"></head><body>');
        nw.document.write('<h1 style="text-align:center;">Top Products ' + (selectedMonthWord ? ' - ' + selectedMonthWord : '') + '</h1>');
        nw.document.write(_content.html());
        nw.document.write('</body></html>');
        nw.document.close();
        nw.print();
        nw.close();
    });

    $('#filter-report').submit(function(e){
        e.preventDefault();
        var selectedMonth = $('input[name="month_of"]').val();
        var url = 'topproduct_report.php';
        if (selectedMonth) {
            url += '?month_of=' + selectedMonth;
        }
        
        $.get(url, function(response) {
            $('.table-responsive').html($(response).find('.table-responsive').html());
        }).fail(function(xhr, status, error) {
            console.error(error);
        });
    });
</script>
