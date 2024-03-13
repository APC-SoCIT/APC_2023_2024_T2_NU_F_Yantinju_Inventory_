
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
                <h1>Customer</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li><a href="adminpanel.php?view_customer">View Customer</a></li>
                    </ul>
                </p>
            </div>
            </div>
            <div class="header-action">
            
            <a class="btn btn-main" href="adminpanel.php?insert_admin">
            <i class="fa-solid fa-user-plus"></i>
                 Add Admin
            </a>
            </div>
        </header>
        <main>
            <section>
            <h3 class="section-head"> List of Registered Users</h3>
           
                <div class="row" ><!-- 2 row Starts -->

                <div class="col-lg-12" ><!-- col-lg-12 Starts -->

                <div class="panel panel-default" ><!-- panel panel-default Starts -->

                <div class="panel-heading" ><!-- panel-heading Starts -->

                <h3 class="panel-title" ><!-- panel-title Starts -->

                <i class="fa-solid fa-people-group"></i> View Users || <i class="fa-solid fa-box-archive" style="color: #115579;"></i> = <b>Change Status</b>

                </h3><!-- panel-title Ends -->


                </div><!-- panel-heading Ends -->

                <div class="panel-body" ><!-- panel-body Starts -->

                <div class="table-responsive" ><!-- table-responsive Starts -->

                <table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

                <thead>

                <tr>
                <th>#</th>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Phone #</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Status</th>
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
$get_pro = "SELECT * FROM users WHERE role='user'";
$run_pro = mysqli_query($conn, $get_pro);

while ($row_pro = mysqli_fetch_array($run_pro)) {
    $id = $row_pro['customer_id'];
    $fname = $row_pro['firstname'];
    $lname = $row_pro['lastname'];
    $mname = $row_pro['middlename'];
    $phone = $row_pro['phone'];
    $email = $row_pro['email'];
    $bday = $row_pro['b_day'];
    $status = $row_pro['status'];
    //$price = $row_pro['price'];
    //$pro_desc = $row_pro['description'];
    $i++;

    if (!function_exists('getInitials')) {
        //get the initial of middle name
        function getInitials($string) {
            $words = explode(' ', $string);
            $initials = ' ';
    
            foreach ($words as $word) {
                $initials .= strtoupper($word[0]) . '.';
            }
    
            return $initials;
        }
    }
    
    // Now you can use the function
    if (!empty($mname)) {
        $initials = getInitials($mname);
    } else {
        // Handle the case when there is no middle name
        $initials = ''; // or any other default value
    }
    
    // Add a class to the table row based on the status
    $row_class = ($status == 'Disabled') ? 'disabled-row' : '';
?>

<tr class="<?php echo $row_class; ?>">

<td><?php echo $i; ?></td>

<td><?php echo $id; ?></td>

<td><?php echo $fname; ?> <?php echo $lname; ?> <?php echo $initials; ?></td>

<td><?php echo $phone; ?></td>

<td><?php echo $email; ?></td>

<td><?php echo $bday; ?></td>

<td><?php echo $status; ?></td>

<td>
    <a href="archive_user.php?archive_user=<?php echo $id; ?>">
        <i class="fa-solid fa-box-archive" style="color: #115579;"></i>
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