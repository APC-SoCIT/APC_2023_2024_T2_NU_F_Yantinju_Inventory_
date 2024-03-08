<style>
    /* Additional style for the two-tone report card design with landscape orientation */
    .report-card-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 90%;
    height: 100%;
    background: #feb47b; /* Updated to a single color */
    border-radius: 10px;
    z-index: -1;
}

    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .card-text {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .card-footer {
        padding: 10px 15px;
        background-color: #f9f9f9;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .card-footer a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .card-footer a:hover {
        color: #0056b3;
    }
</style>

<input type="checkbox" name="" id="menu-toggle">
<div class="overlay"><label for="menu-toggle"></label></div>

<div class="main-content">
    <header>
        <div class="header-wrapper">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>
            <div class="header-title">
                <h1>Reports</h1>
                <p>
                    <ul class="breadcrumb" style="background-color:#f5eedc; padding: 0 0; font-size: 0.9rem;">
                        <li>Report</li>
                    </ul>
                </p>
            </div>
        </div>
    </header>
    <main>
        <section>
            <h3 class="section-head">List of Reports</h3>
            <div class="row">
                <?php
                $reports = array(
                    "adminpanel.php?sales_report" => "Monthly Sales Report",
                    "adminpanel.php?topproduct_report" => "Top Products Report",
                    "adminpanel.php?numusers_report" => "Number of Users Reports",
                    // Add more reports as needed
                );

                foreach ($reports as $page => $title) {
                    ?>
                    <div class="col-sm-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $title; ?></h4>
                                <p class="card-text">Gain insights into <?php echo strtolower($title); ?>.</p>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo $page; ?>" class="d-flex justify-content-between align-items-center">
                                    <span>View Report</span> <span class="fa fa-chevron-circle-right"></span>
                                </a>
                            </div>
                        </div>
                        <!-- Adding two-tone card design with landscape orientation behind each report tab -->
                        <div class="report-card-background"></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </main>
</div>

<!-- this is your alert stock -->
<?php include 'stockalert.php'; ?>
<!-- end of alert stock -->

<script>
    // Activate the correct tab based on URL parameters
    window.addEventListener('DOMContentLoaded', function () {
        let urlParams = new URLSearchParams(window.location.search);
        let page = urlParams.get('page');
        if (page) {
            let activeTab = document.querySelector('a[href="adminpanel.php?page=' + page + '"]');
            if (activeTab) {
                activeTab.classList.add('active');
            }
        }
    });
</script>
