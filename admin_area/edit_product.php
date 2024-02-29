<?php

$edit_id = $_GET['edit_product'];

$get_p = "select * from paninda where title='$edit_id'";

$run_edit = mysqli_query($conn,$get_p);

$row_edit = mysqli_fetch_array($run_edit);

$p_id = $row_edit['id'];

$p_title = $row_edit['title'];

$cat = $row_edit['category'];

$p_image1 = $row_edit['img1'];

//$p_image2 = $row_edit['img2'];

$quantity = $row_edit['stock'];

$new_p_image1 = $row_edit['img1'];

//$new_p_image2 = $row_edit['img2'];

//$new_p_image3 = $row_edit['img3'];

$p_price = $row_edit['price'];

$p_desc = $row_edit['description'];



$get_p_cat = "select * from categories where category='$cat'";

$run_p_cat = mysqli_query($conn,$get_p_cat);

$row_p_cat = mysqli_fetch_array($run_p_cat);

$p_cat_title = $row_p_cat['category'];

$get_cat = "select * from categories where category='$cat'";

$run_cat = mysqli_query($conn,$get_cat);

$row_cat = mysqli_fetch_array($run_cat);

$cat_title = $row_cat['category'];

?>


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
                        <li><a href="adminpanel.php?products2">Products</a></li>
                        <li>Edit Product</li>
                    </ul>
                </p>
            </div>
            </div>
            
        </header>
        <main>
            <section>
            <h3 class="section-head">List of Products</h3>

            <form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->
                
                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product ID </label>

                <div class="col-md-6" >

                <input type="text" name="product_id" class="form-control" required value="<?php echo $p_id; ?>" readonly>

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Title </label>

                <div class="col-md-6" >

                <input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>">

                </div>

                </div><!-- form-group Ends -->


                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Category </label>

                <div class="col-md-6" >


                <select name="cat" class="form-control" onchange="this.selectedIndex = 0;">

                <option value="<?php echo $cat; ?>" ><?php echo $p_cat_title; ?>  </option>

                    <?php
                        $get_cat = "SELECT * FROM categories";

                        $run_cat = mysqli_query($conn, $get_cat);

                        while ($row_cat = mysqli_fetch_array($run_cat)) {

                            $cat_id = $row_cat['id'];

                            $category = $row_cat['category'];

                            echo "<option>$category</option>";
                        }
                    ?>


                </select>

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Image 1 </label>

                <div class="col-md-6" >

                <!-- Input for changing the image -->

                <input type="file" name="product_img1" class="form-control">

                    <!-- Display the current image -->
                    <?php if (!empty($p_image1)) : ?>

                    <img src="images/products/<?php echo $p_image1; ?>" alt="Product Image 1" style="max-width: 100px; max-height: 100px;">

                    <?php endif; ?>

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Product Price </label>

                <div class="col-md-6" >

                <input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>" >

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" > Quantity</label>

                <div class="col-md-6" >

                <input type="number" name="product_quantity" class="form-control" required value="<?php echo $quantity; ?>" >

                </div>

                </div><!-- form-group Ends -->
               
                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" >  Product Description </label>

                <div class="col-md-6" >

                <div id="description" class="tab-pane fade in active"><!-- description tab-pane fade in active Starts -->

                <textarea name="product_desc" class="form-control" rows="5" id="product_desc"><?php echo $p_desc; ?></textarea>

                </div><!-- description tab-pane fade in active Ends -->

                </div>

                </div><!-- form-group Ends -->

                <div class="form-group" ><!-- form-group Starts -->

                <label class="col-md-3 control-label" ></label>

                <div class="col-md-6" >

                <input type="submit" name="update" value="Update Product" class="btn btn-primary form-control" >

                </div>

                </div><!-- form-group Ends -->

                </form><!-- form-horizontal Ends -->

                </div><!-- panel-body Ends -->

                </div><!-- panel panel-default Ends -->

                </div><!-- col-lg-12 Ends -->

                </div><!-- 2 row Ends --> 


            </section>
        </main>
        </div>

<?php

if(isset($_POST['update'])){

$product_id = $_POST['product_id'];
$product_title = $_POST['product_title'];
$cat = $_POST['cat'];
$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];
$product_desc = $_POST['product_desc'];
$status = "Available";


$product_img1 = $_FILES['product_img1']['name'];
//$product_img2 = $_FILES['product_img2']['name'];
//$product_img3 = $_FILES['product_img3']['name'];

$temp_name1 = $_FILES['product_img1']['tmp_name'];
//$temp_name2 = $_FILES['product_img2']['tmp_name'];
//$temp_name3 = $_FILES['product_img3']['tmp_name'];

if(empty($product_img1)){

$product_img1 = $new_p_image1;

}


if(empty($product_img2)){

//$product_img2 = $new_p_image2;

}

if(empty($product_img3)){

//$product_img3 = $new_p_image3;

}


move_uploaded_file($temp_name1,"images/products/$product_img1");
//move_uploaded_file($temp_name2,"images/products/$product_img2");
//move_uploaded_file($temp_name3,"images/products/$product_img3");

$update_product = "UPDATE paninda SET category='$cat', title='$product_title', img1='$product_img1', stock='$product_quantity', price='$product_price', description='$product_desc', status='$status' where id='$product_id'";

$run_product = mysqli_query($conn,$update_product);

if($run_product){

echo "<script> alert('Product has been updated successfully') </script>";

echo "<script>window.open('adminpanel.php?products2','_self')</script>";

}

}

?>

