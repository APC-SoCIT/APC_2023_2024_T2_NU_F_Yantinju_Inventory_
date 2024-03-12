<?php 

session_start();
include "db_conn.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

    if(isset($_POST['update_update_btn'])){
        $update_value = $_POST['update_quantity'];
        $update_id = $_POST['update_quantity_id'];
        $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
        if($update_quantity_query){
            echo "<script>window.open('cart.php?confirm=logged_in','_self')</script>";
        };
     };
     
     if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
        header('location:cart.php?confirm=logged_in');
     };
     
     if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM `cart`");
        echo "<script>window.open('cart.php?confirm=logged_in','_self')</script>";
     }     


    

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart View - Yantinju Shop</title>
    <link rel="icon" href="admin_area/images/users/icon.jpg">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/homepage.css">

    <!-- css library bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- js library bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- font awesome icons library-->
    <script src="https://kit.fontawesome.com/eab754ee3b.js" crossorigin="anonymous"></script>
    <!-- tailwind css library -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0.3/dist/tailwind.min.css">
    
</head>
<body>
   
        <!-- this is your header -->
        <?php
            include 'header.php';
        ?>
        <!--    end of navbar    -->

            <div class="container">

                <section class="shopping-cart" id="shopping-cart">

                <table>

                    <thead>
                        <th>image</th>
                        <th><span style="float: left;">product name</span> <span style="float: right;">(size)</span></th>
                        <th style="width: 9.6%">price</th>
                        <th><span style="float: left;">quantity</span> </th>
                        <th style="width: 10%">total price</th>
                        <th>action</th>
                    </thead>

                    <tbody>

                        <?php 
                        //$filter_cart = mysqli_query($conn, "DELETE FROM `cart`");

                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE phone={$_SESSION['phone']}");
                        $grand_total = 0;
                        if(mysqli_num_rows($select_cart) > 0){
                            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                            
                        ?>

                        <tr>
                            <td><img src="admin_area/images/products/<?php echo $fetch_cart['img1']; ?>" style="display: block; margin: 0 auto; max-width: 100px; max-height: 100px;" alt=""></td>
                            <td>
                            <span style="float: left;"><?php echo $fetch_cart['title']; ?></span>
                            <?php if($fetch_cart['size'] > 0): ?>
                                <span style="float: right;">(<?php echo $fetch_cart['size']; ?>)</span>
                            <?php endif; ?>
                            </td>
                            <td>
                                <span style="float: left;">₱</span>
                                <span style="float: right;"><?php echo number_format($fetch_cart['price'], 2); ?></span>
                            </td>
                            <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                                <?php 
                                $select_item = mysqli_query($conn, "SELECT * FROM `paninda` WHERE title='{$fetch_cart['title']}'"); 
                                $fetch_item = mysqli_fetch_assoc($select_item);
                                $quantity = $fetch_item['stock'];
                                $category = $fetch_item['category'];
                                $id3 = $fetch_item['id'];

                                if ($category !== 'Rings' && $category !== 'Necklaces'){
                                    if ($quantity >= $fetch_cart['quantity']){ ?>
                                        <input type="number" name="update_quantity" min="1" max="<?php echo $quantity ?>"  value="<?php echo $fetch_cart['quantity']; ?>" onkeypress="if(event.keyCode==13) { limitInputToMax(this); return false; }">
                                    <?php } elseif ($quantity < $fetch_cart['quantity']){ ?>
                                        <input type="number" name="update_quantity" min="1" max="<?php echo $quantity ?>"  value="<?php echo $quantity ?>" onkeypress="if(event.keyCode==13) { limitInputToMax(this); return false; }">
                                    <?php mysqli_query($conn, "UPDATE `cart` SET quantity = '$quantity' WHERE id = '{$fetch_cart['id']}'");
                                        } elseif ($quantity === 0){
                                            mysqli_query($conn, "DELETE FROM `cart` WHERE id = '{$fetch_cart['id']}'");
                                        }
                                } else {
                                    
                                $select_item2 = mysqli_query($conn, "SELECT * FROM `size` WHERE id='$id3' AND size={$fetch_cart['size']}"); 
                                $fetch_item2 = mysqli_fetch_assoc($select_item2);
                                $quantity2 = $fetch_item2['stock'];
                                
                                    if ($quantity2 >= $fetch_cart['quantity']){ ?>
                                        <input type="number" name="update_quantity" min="1" max="<?php echo $quantity2 ?>"  value="<?php echo $fetch_cart['quantity']; ?>" onkeypress="if(event.keyCode==13) { limitInputToMax(this); return false; }">
                                    <?php } elseif ($quantity2 < $fetch_cart['quantity']){ ?>
                                        <input type="number" name="update_quantity" min="1" max="<?php echo $quantity2 ?>"  value="<?php echo $quantity2 ?>" onkeypress="if(event.keyCode==13) { limitInputToMax(this); return false; }">
                                    <?php mysqli_query($conn, "UPDATE `cart` SET quantity = '$quantity2' WHERE id = '{$fetch_cart['id']}'");
                                    } elseif ($quantity2 === 0){

                                    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '{$fetch_cart['id']}'");
                                    ?>

                                <?php
                                    }
                                } 
                                ?>

                            <script>
                                // JavaScript function to limit input value to maximum when user presses Enter
                                function limitInputToMax(input) {
                                    var maxValue = parseInt(input.getAttribute('max')); // Get the maximum value
                                    var enteredValue = parseInt(input.value); // Get the entered value

                                    // If the entered value exceeds the maximum value, set it to the maximum value
                                    if (enteredValue > maxValue) {
                                        input.value = maxValue;
                                    }
                                }
                            </script>

                                <input type="submit" value="update" name="update_update_btn">
                            </form>   
                            </td>
                            <td>
                                <span style="float: left;">₱</span><span style="float: right;"><?php echo number_format($sub_total = $fetch_cart['price'] * $fetch_cart['quantity'], 2); ?></span>
                            </td>
                            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>&confirm=logged_in" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                        </tr>
                        <?php
                        $grand_total += $sub_total;  
                        $with_vat = $grand_total * .12;
                        $final_total = $grand_total + $with_vat + 50;
                            };
                        };
                        ?>
                        <?php
                        if ($grand_total > 0) { // Check if grand_total is greater than 0
                        ?>
                        <tr class="table-bottom1">
                            <td style="border-bottom: none;"></td>
                            <td colspan="3" style="border-bottom: none;"><b>Subtotal</b></td>
                            <td style="border-bottom: none;">
                                <span style="float: left;">₱</span>
                                <span style="float: right;"><?php echo number_format($grand_total, 2); ?></span>
                            </td>
                            <td style="border-bottom: none;"></td>
                        </tr>
                        <tr class="table-bottom1">
                            <td style="border-bottom: none;"></td>
                            <td colspan="3" style="border-bottom: none;"><b>VAT 12%</b></td>
                            <td style="border-bottom: none;">
                                <span style="float: left;">₱</span>
                                <span style="float: right;"><?php echo number_format($with_vat, 2); ?></span>
                            </td>
                            <td style="border-bottom: none;"></td>
                        </tr>
                        <tr class="table-bottom1">
                            <td></td>
                            <td colspan="3"><b>Shipping Fee</b></td>
                            <td>
                                <span style="float: left;">₱</span>
                                <span style="float: right;"><?php echo number_format(50, 2); ?></span>
                            </td>
                            <td></td>
                        </tr>
                       
                        <tr class="table-bottom">
                            <td><a href="products.php?confirm=logged_in" class="option-btn" style="margin-top: 0;"><- continue shopping</a></td>
                            <td colspan="3"><b>grand total:<b></td>
                            <td>
                                <span style="float: left;">₱</span>
                                <span style="float: right;"><b><?php echo number_format($final_total, 2); ?></b></td></span>
                            <td><a href="cart.php?delete_all&confirm=logged_in" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
                        </tr>
                        <?php
                        } // End of if statement for VAT row
                    
                        ?>

                    </tbody>

                </table>

                <div class="checkout-btn">
                    <a href="checkout.php?confirm=logged_in" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
                </div>

                </section>

            </div>

        <!-- this is your footer -->
        <?php
            include 'footer.php';
        ?>
        <!--    end of footer    -->
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>