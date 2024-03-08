<?php
// Include the database connection file
include "db_conn.php";

// Check if the connection is established
if (!$conn) {
    // Handle the connection error
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get initials
function getInitials($string) {
    $words = explode(' ', $string);
    $initials = '';

    foreach ($words as $word) {
        $initials .= strtoupper($word[0]) . '.';
    }

    return $initials;
}

// Fetch data from the database
$sql = "SELECT * FROM users WHERE role='user'";
$result = mysqli_query($conn, $sql);
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
                <h1>Number of Users</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?report">Report</a></li>
                        <li>Number of Users Report</li>
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
                            <h3 class="panel-title">List of Registered Users</h3>
                        </div>
                        <div class="panel-body">
                            <div class="btn-wrapper">
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
                                            <th>Phone #</th>
                                            <th>Email</th>
                                            <th>Birthday</th>
                                            <th>Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row_pro = mysqli_fetch_array($result)) {
                                            $i++;
                                            $id = $row_pro['customer_id'];
                                            $fname = $row_pro['firstname'];
                                            $lname = $row_pro['lastname'];
                                            $mname = $row_pro['middlename'];
                                            $phone = $row_pro['phone'];
                                            $email = $row_pro['email'];
                                            $bday = $row_pro['b_day'];
                                            $gender = $row_pro['gender'];

                                            // Now you can use the function
                                            if (!empty($mname)) {
                                                $initials = getInitials($mname);
                                            } else {
                                                // Handle the case when there is no middle name
                                                $initials = ''; // or any other default value
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $fname . ' ' . $lname . ' ' . $initials; ?></td>
                                            <td><?php echo $phone; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $bday; ?></td>
                                            <td><?php echo $gender; ?></td>
                                        </tr>
                                        <?php } ?>
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
    var _content = $('main').clone();
    // Remove print button
    _content.find('.btn-wrapper').remove();
    
    var nw = window.open("","_blank","width=800,height=700");
    nw.document.write('<html><head><title>Yantinju Accessories</title><link rel="stylesheet" href="css/bootstrap.min.css"></head><body>');
    nw.document.write('<h1 style="text-align:center;">Number of Users Report</h1>');
    nw.document.write(_content.html());
    nw.document.write('</body></html>');
    nw.document.close();
    nw.print();
    nw.close();
});
</script>
