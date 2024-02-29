<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            // Check stocks and trigger SweetAlert if below 20
            <?php
            $get_stock_query = "SELECT title, stock FROM `paninda`";
            $run_stock_query = mysqli_query($conn, $get_stock_query);
    
            while ($stock_result = mysqli_fetch_assoc($run_stock_query)) {
                $product_name = $stock_result['title'];
                $quantity = $stock_result['stock'];
    
                if ($quantity < 20) {
            ?>
                    Swal.fire({
                        icon: "error",
                        title: "Low Stock",
                        text: "Stock for <?php echo $product_name; ?> is running low! Current stock: <?php echo $quantity; ?>",
                        footer: '<a href="adminpanel.php?products2">Check your inventory</a>'
                    });
            <?php
                }
            }
            ?>
        </script>