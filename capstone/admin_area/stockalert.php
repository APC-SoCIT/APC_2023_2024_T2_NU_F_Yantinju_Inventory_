<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Check stocks and trigger SweetAlert if below 20
    <?php
    $get_stock_query = "SELECT * FROM `paninda` WHERE status='Available'";
    $run_stock_query = mysqli_query($conn, $get_stock_query);

    while ($stock_result = mysqli_fetch_assoc($run_stock_query)) {
        $product_name = $stock_result['title'];
        $quantity = $stock_result['stock'];
        $id = $stock_result['id'];
        $cate = $stock_result['category'];
        $stats = $stock_result['status'];

        // Check if the product is a "Ring" or "Necklace"
        if ($cate === "Rings" || $cate === "Necklaces") {
            $get_stock_query0 = "SELECT * FROM `size` WHERE id='$id' AND size IN (14, 16, 18, 20, 24)";
            $run_stock_query0 = mysqli_query($conn, $get_stock_query0);

            // Initialize a flag variable to track if any size is below 20
            $isLowStock = false;

            while ($stock_result0 = mysqli_fetch_assoc($run_stock_query0)) {
                $quantity2 = $stock_result0['stock'];
                $size2 = $stock_result0['size'];

                if ($quantity2 < 20 && $quantity2 >= 0) {
                    // If any size is below 20, set the flag to true
                    $isLowStock = true;
                }
            }

            // If any size is below 20, trigger the alert
            if ($isLowStock) {
                ?>
                Swal.fire({
                    icon: "warning",
                    title: "Low Stock",
                    text: "One of the stock for <?php echo $product_name; ?> is running low! Refill Immediately",
                    footer: `<a href="adminpanel.php?edit_product=<?php echo urlencode($product_name); ?>&category=<?php echo urlencode($cate); ?>&id=<?php echo $id; ?>">Check your inventory</a>`
                });
                <?php
            }
        } else {
            // For other categories, check if the total quantity is below 20
            if ($quantity < 20 && $quantity > 0) {
                ?>
                Swal.fire({
                    icon: "error",
                    title: "Low Stock",
                    text: "Stock for <?php echo $product_name; ?> is running low! Current stock: <?php echo $quantity; ?>",
                    footer: `<a href="adminpanel.php?edit_product=<?php echo urlencode($product_name); ?>&category=<?php echo urlencode($cate); ?>&id=<?php echo $id; ?>">Check your inventory</a>`
                });
                <?php
            } elseif ($quantity === 0) {
                ?>
                Swal.fire({
                    icon: "error",
                    title: "Empty Stock",
                    text: "Stock for <?php echo $product_name; ?> is Empty! Refill Immediately",
                    footer: `<a href="adminpanel.php?edit_product=<?php echo urlencode($product_name); ?>&category=<?php echo urlencode($cate); ?>&id=<?php echo $id; ?>">Check your inventory</a>`
                });
                <?php
            }
        }
    } ?>
</script>
