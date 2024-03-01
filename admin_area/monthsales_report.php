<?php
// Include the database connection file
include "db_conn.php";

// Function to get initials
function getInitials($string) {
    $words = explode(' ', $string);
    $initials = '';

    foreach ($words as $word) {
        $initials .= strtoupper($word[0]) . '.';
    }

    return $initials;
}

// Set default month to current month
$current_month = date('Y-m');
$month_of = isset($_GET['month_of']) ? $_GET['month_of'] : '';

// Initialize SQL query to fetch data from the database
$sql = "SELECT * FROM `complete_order` WHERE status='Product Delivered'";
if (!empty($month_of)) {
    $sql .= " AND DATE_FORMAT(`DateTime`, '%Y-%m') = '$month_of'";
}

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Initialize total amount variable
$total_amount = 0;

// Loop through the fetched rows to calculate total amount
while ($row = mysqli_fetch_assoc($result)) {
    // Check if the "total_price" key exists
    if (isset($row['total_price'])) {
        $total_amount += $row['total_price'];
    } else {
        // If the key doesn't exist, set amount to 0
        $total_amount += 0;
    }
}
?>


<input type="checkbox" name="" id="menu-toggle">
<div class="overlay"><label for="menu-toggle"></label></div>

<div class="main-content">
    <header>
        <div class="header-wrapper">
        <label for="menu-toggle">
            <span class="las la-bars"></span>
        </label>
        <div class="header-title">
            <h1>Sales Report</h1>
            <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?report">Report</a></li>
                        <li>Monthly Sales Report</li>
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
                            <h3 class="panel-title">Monthly Sales</h3>
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
                                    <div class="form-group">
                                        <button class="btn btn-sm btn-danger" type="button" id="clear-filter">Clear</button>
                                    </div>
                                </form>
                                <!-- Print button -->
                                <button class="btn btn-sm btn-success" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer ID</th>
                                            <th>Name</th>
                                            <th>Products Ordered</th>
                                            <th style="width:5.3rem;">Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        // Reset result pointer
                                        mysqli_data_seek($result, 0);
                                        while ($row_pro = mysqli_fetch_assoc($result)) {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row_pro['customer_id']; ?></td>
                                            <td><?php echo $row_pro['fname'] . ' ' . $row_pro['lname']; ?></td>
                                            <td><?php echo $row_pro['total_products']; ?></td>
                                            <td><?php echo date('M d', strtotime($row_pro['DateTime'])); ?></td>
                                            <td>
                                                <span style="float: left;">₱</span><span style="float: right;"><?php echo isset($row_pro['total_price']) ? $row_pro['total_price'] : 0; ?></span>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <!-- Display total amount row -->
                                        <tr>
                                            <td colspan="5" align="right">Total Amount:</td>
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
    nw.document.write('<html><head><title>Monthly Sales Report</title><link rel="stylesheet" href="css/bootstrap.min.css"></head><body>');
    nw.document.write('<div class="logo"><img src="images/icon.png" alt="" style="max-width: 50px; max-height: 50px;"></div>'); // Include the logo
    nw.document.write('<h1 style="text-align:center;margin-bottom:20px;">Monthly Sales Report ' + (selectedMonthWord ? ' - ' + selectedMonthWord : '') + '</h1>');
    nw.document.write('<table class="table table-bordered table-hover table-striped" style="margin-bottom:20px;"><thead><tr><th>#</th><th>Customer ID</th><th>Name</th><th>Products Ordered</th><th style="width:5.3rem;">Date</th><th>Amount</th></tr></thead><tbody>');
    
    var i = 0;
    $("main table tbody tr").each(function() {
        i++;
        var customerId = $(this).find("td:eq(1)").text();
        var name = $(this).find("td:eq(2)").text();
        var productsOrdered = $(this).find("td:eq(3)").text();
        var date = $(this).find("td:eq(4)").text();
        var amount = $(this).find("td:eq(5)").text();
        nw.document.write('<tr><td>'+i+'</td><td>'+customerId+'</td><td>'+name+'</td><td>'+productsOrdered+'</td><td>'+date+'</td><td>'+amount+'</td></tr>');
    });
    
    nw.document.write('</tbody></table>');
    nw.document.write('<p style="text-align:right;margin-bottom:20px;">Total Amount: <?php echo number_format($total_amount,2); ?></p>');
    nw.document.write('</body></html>');
    nw.document.close();
    nw.print();
    nw.close();
});



$('#filter-report').submit(function(e){
    e.preventDefault();
    var selectedMonth = $('input[name="month_of"]').val();
    var url = 'monthsales_report.php';
    if (selectedMonth) {
        url += '?month_of=' + selectedMonth;
    }
    
    $.get(url, function(response) {
        $('.table-responsive').html($(response).find('.table-responsive').html());
    }).fail(function(xhr, status, error) {
        console.error(error);
    });
});

// Add event listener for the "Clear" button
$('#clear-filter').click(function() {
    $('input[name="month_of"]').val('');
    $('#filter-report').submit();
});
</script>
