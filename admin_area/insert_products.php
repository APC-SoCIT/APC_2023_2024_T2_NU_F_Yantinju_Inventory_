
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
                        <li><a href="adminpanel.php?products2">Products</a></li>
                        <li>Upload Product</li>
                    </ul>
                </p>
            </div>
            
        </header>
        <main>
            <section>
            <h3 class="section-head">Create Product</h3>
            
                <form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Title </label>

                <div class="col-md-6" >

                <input type="text" name="product_title" class="form-control" required>

                </div>

                </div><!-- form-group Ends -->


                    <div class="form-group" ><!-- form-group Starts -->

                    <label class="col-md-3 control-label" > Category </label>

                    <div class="col-md-6" >


                    <select name="cat" class="form-control" onchange="showStockFields(this.value)">
                    <option> Select a Category </option>
                    <?php
                        $get_cat = "SELECT * FROM categories";
                        $run_cat = mysqli_query($conn, $get_cat);
                        while ($row_cat = mysqli_fetch_array($run_cat)) {
                            $cat_id = $row_cat['id'];
                            $category = $row_cat['category'];
                            echo "<option value='$category'>$category</option>";
                        }
                    ?>
                </select>

                    </div>

                </div><!-- form-group Ends -->

                
                <script>
                    function showStockFields(selectedCategory) {
                        const stockFieldsDiv = document.getElementById('stockFields');
                        const stockInput = document.getElementsByName('product_count')[0];
                        if (selectedCategory == 'Rings' || selectedCategory == 'Necklaces') {
                            stockFieldsDiv.innerHTML = '';
                            const sizes = [14, 16, 18, 20, 24];
                            sizes.forEach(size => {
                                stockFieldsDiv.innerHTML += `
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Size ${size} Stock </label>
                                        <div class="col-md-6">
                                            <input type="number" name="product_size_${size}_stock" class="form-control" required>
                                        </div>
                                    </div>`;
                            });
                            stockInput.readOnly = true;
                        } else {
                            stockFieldsDiv.innerHTML = '';
                            stockInput.readOnly = false; // Make the "No. of Stocks" field editable
                        }
                    }
                </script>

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Image 1 </label>

                <div class="col-md-6" >

                <input type="file" name="product_img1" class="form-control" required >

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > No. of Stocks </label>

                <div class="col-md-6" >

                <input type="number" name="product_count" class="form-control" required >

                </div>

                </div><!-- form-group Ends -->

                
                <div id="stockFields"></div>

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Price </label>

                <div class="col-md-6" >

                <input type="text" name="product_price" class="form-control" required >

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Description </label>

                <div class="col-md-6" >

                <div id="description" class="tab-pane fade in active"><!-- description tab-pane fade in active Starts -->


                <textarea name="product_desc" class="form-control" rows="5" id="product_desc">


                </textarea>

                </div><!-- description tab-pane fade in active Ends -->

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" ></label>

                <div class="col-md-6" >

                <input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control" >

                </div>

                </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->

                </div><!-- panel-body Ends -->

                </div><!-- panel panel-default Ends -->

                </div><!-- col-lg-12 Ends -->

                </div><!-- 2 row Ends --> 


                </main>
                </div>


            </section>
        </main>
        </div>


        <?php
if (isset($_POST['submit'])) {
    $n = 10;
    function get_id($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return strtoupper($randomString);
    }

    $order_id = get_id($n);
    $product_img1 = mysqli_real_escape_string($conn, $_FILES['product_img1']['name']);
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $product_cat = mysqli_real_escape_string($conn, $_POST['cat']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_desc = mysqli_real_escape_string($conn, $_POST['product_desc']);
    $status = "Available";

    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    move_uploaded_file($temp_name1, "images/products/$product_img1");

    // Insert product information into the database
    $insert_product = "INSERT INTO paninda (id, title, category, img1, price, description, status) VALUES ('$order_id', '$product_title', '$product_cat', '$product_img1', '$product_price', '$product_desc', '$status')";

    if ($product_cat == 'Rings' || $product_cat == 'Necklaces') {
        $run_product = mysqli_query($conn, $insert_product);

        if ($run_product) {
            // Insert stock information into the database for each size
            for ($i = 14; $i <= 24; $i += 2) {
                $product_size_stock = mysqli_real_escape_string($conn, $_POST["product_size_${i}_stock"]);
                $insert_stock = "INSERT INTO size (id, size, stock) VALUES ('$order_id', '$i', '$product_size_stock')";
                $run_stock = mysqli_query($conn, $insert_stock);
            }

?>
                <script>
                    Swal.fire({
                        title: "You want to add more?",
                        text: "Product and stock have been inserted successfully!",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Yes, add more",
                        cancelButtonText: "No"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "adminpanel.php?insert_products";
                        } else {
                            window.location.href = "adminpanel.php?products2";
                        }
                    });
                </script>
<?php
 
        } else {
            // Handle errors if product insertion fails
            echo "Error inserting product into the database: " . mysqli_error($conn);
        }
    } else {
        echo "Product and stock insertion is only allowed for Rings and Necklaces category.";
    }
}
?>
