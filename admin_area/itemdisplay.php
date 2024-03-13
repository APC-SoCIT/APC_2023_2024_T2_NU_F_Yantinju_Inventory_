<?php
// Include your database connection file here
include 'db_conn.php';

$email = $_SESSION['email'];

$view_pro = $_GET['products'];
$view_pro = mysqli_real_escape_string($conn, $view_pro);

$get_pro2 = "SELECT * FROM `paninda` WHERE title='$view_pro'";
$run_pro2 = mysqli_query($conn, $get_pro2);

$row_pro2 = mysqli_fetch_array($run_pro2);
$title = htmlspecialchars($row_pro2['title']);
$cat = htmlspecialchars($row_pro2['category']);
$img1 = htmlspecialchars($row_pro2['img1']);
$stock = htmlspecialchars($row_pro2['stock']);
$price = htmlspecialchars($row_pro2['price']);
$desc = htmlspecialchars($row_pro2['description']);
$product_id = $row_pro2['id']; // Assuming 'id' is the column name for the product ID

$get_user = "SELECT * FROM `users` WHERE email='" . $_SESSION['email'] . "'";
$run_user2 = mysqli_query($conn, $get_user);

$row_user2 = mysqli_fetch_array($run_user2);
$fname = htmlspecialchars($row_user2['firstname']);
$lname = htmlspecialchars($row_user2['lastname']);
$pic = htmlspecialchars($row_user2['profilepic']);

$fullname = $fname . ' ' . $lname;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Display</title>

<!-- CSS for star ratings -->
<style>
  /* Paste the CSS for star ratings here */
  /* These styles are applied by default.
     They will also override the hover
     style for all stars to the right
     of the currently hovered star. */
  .rate i,
  .rate i:hover ~ i {
    color: #222;
    text-shadow: none;
    transition: color 200ms, text-shadow 200ms;
    /* This will remove the delay when
       moving the cursor left or right
       within the set of stars. */
    transition-delay: 0;
  }

  /* This is the style that will be
     applied to all stars and then
     subsequently removed from the stars
     to the right of the one being
     hovered. */
  .rate:hover i {
    color: #fc0;
    text-shadow: #fc0 0 0 20px;
  }

  /* Miscellaneous styles. */
  .rate i {
    cursor: pointer;
    font-style: normal;
  }

  /* Add styles for the size buttons */
  .product-sizes {
    margin-top: 10px;
  }

  .size-button {
    background-color: transparent;
    color: #000;
    padding: 8px 16px;
    cursor: pointer;
    border: 1px solid #000;
    margin-right: 10px;
  }

  .size-button:last-child {
    margin-right: 0;
  }

  .size-button:hover {
    background-color: #000;
    color: #fff;
  }

  .size-button.active {
    background-color: #000;
    color: #fff;
  }

  .rate .star {
    cursor: pointer;
    font-size: 24px;
    color: gray;
  }

  .rate .star.active {
    color: gold;
  }

  /* Comment Section Styles */
  .comment-section {
    margin-top: 20px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
  }

  .comment-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .comment-form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  .comment-form button:hover {
    background-color: #0056b3;
  }

  .comments {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .comment {
    margin-bottom: 20px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
  }

  .comment p {
    margin: 0;
  }

  .comment .author {
    font-weight: bold;
    margin-bottom: 5px;
  }

  .comment .date {
    color: #666;
    font-size: 12px;
  }
</style>
</head>
<body>

<div class="header-title">
</div>
<div class="card-wrapper">

  <div class="card">
    <!-- card left -->
    <div class="product-imgs">
      <div class="img-display">
        <div class="img-showcase">
          <img src="admin_area/images/products/<?php echo $img1 ?>" alt="item image">
        </div>
      </div>
    </div>
    
    <!-- card right -->
    <div class="product-content">
  

    <?php
      if($login == 'logged_in') {
    ?>
      <ul class="breadcrumb" style="background-color: #fff; padding: 0px 0px">
        <li><a href="products.php?confirm=logged_in" style="color: #000;">All</a></li>
        <li><a href="products.php?<?php echo $cat; ?>&confirm=logged_in" style="color: #000;"><?php echo $cat; ?></a></li>
        <li style="color: #000;"><?php echo $title; ?></li>
      </ul>
    <?php
      }else {
    ?>
      <ul class="breadcrumb" style="background-color: #fff; padding: 0px 0px">
        <li><a href="products.php?confirm=notlogged_in" style="color: #000;">All</a></li>
        <li><a href="products.php?<?php echo $cat; ?>&confirm=notlogged_in" style="color: #000;"><?php echo $cat; ?></a></li>
        <li style="color: #000;"><?php echo $title; ?></li>
      </ul>
    <?php
      }
    ?>
      <h2 class="product-title"><?php echo $title ?></h2>
      <?php
      // Retrieve initial rating and total reviews for the product from your database
        $get_rating_query = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM ratings WHERE product_id='$product_id'";
        $get_rating_result = mysqli_query($conn, $get_rating_query);
        $rating_row = mysqli_fetch_assoc($get_rating_result);
        $initial_rating = $rating_row['avg_rating'] ?: 0; 
        $total_reviews = $rating_row['total_reviews'] ?: 0; 
        
        if($login == 'logged_in') {
        ?>
      <div class="product-rating" id="product-rating" data-product-id="<?php echo $product_id ?>">
        <span class="rate" style="font-size: 24px;"> <!-- Adjust the font-size as needed -->
          <i class="star<?php if ($initial_rating >= 1) echo ' active'; ?>" data-rating="1">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 2) echo ' active'; ?>" data-rating="2">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 3) echo ' active'; ?>" data-rating="3">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 4) echo ' active'; ?>" data-rating="4">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 5) echo ' active'; ?>" data-rating="5">&#9733;</i>
        </span>
        <span id="total-ratings"><?php echo number_format($initial_rating, 1) . ' (' . $total_reviews . ')'; ?></span>
      </div>
        <?php
        }else {
        ?>
      <div class="product-rating" data-product-id="<?php echo $product_id ?>">
        <span class="rate" style="font-size: 24px;"> <!-- Adjust the font-size as needed -->
          <i class="star<?php if ($initial_rating >= 1) echo ' active'; ?>" data-rating="1">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 2) echo ' active'; ?>" data-rating="2">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 3) echo ' active'; ?>" data-rating="3">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 4) echo ' active'; ?>" data-rating="4">&#9733;</i>
          <i class="star<?php if ($initial_rating >= 5) echo ' active'; ?>" data-rating="5">&#9733;</i>
        </span>
        <span id="total-ratings"><?php echo number_format($initial_rating, 1) . ' (' . $total_reviews . ')'; ?></span>
      </div>
        <?php
        }
        ?>

      <div class="product-price">
        <p class="new-price"><span>₱ <?php echo $price ?></span></p>
      </div>

      <div class="product-detail">
        <h2>Description </h2>
        <p><?php echo $desc ?></p>
      </div>

      <?php
      if($login == 'logged_in') {
  
        if($cat == 'Necklaces' || $cat == 'Rings') {
      ?>

            <!-- Size Buttons --> 
            <div class="product-sizes">
                <?php 
                // Fetch stock for each size

                $get_prosize0 = "SELECT * FROM paninda WHERE title='$view_pro'";
                $run_prosize0 = mysqli_query($conn, $get_prosize0);
                $row_prosize0 = mysqli_fetch_array($run_prosize0);
                $id0 = $row_prosize0['id'];

                $get_prosize = "SELECT * FROM size WHERE id='$id0' AND size IN (14, 16, 18, 20, 24)";
                $run_prosize = mysqli_query($conn, $get_prosize);
                // Loop through each row to check stock
                while($row_prosize = mysqli_fetch_array($run_prosize)) {
                    $size = $row_prosize['size'];
                    $stock = $row_prosize['stock'];
                    // Display the size button only if stock > 0
                    if ($stock > 0) {
                        ?>
                        <button class="size-button" data-size="<?php echo $size ?>" onclick="selectSize('<?php echo $size ?>')"><?php echo $size ?></button>
                        <?php
                    }
                }
                ?>
            </div>

      <div id="selected-size" style="margin-top:1rem;"></div>

      <!-- Number field for quantity -->
      <div id="quantity-container" style="display: none;">
        <div class="product-quantity">
          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" name="quantity" min="1" style="padding: 3px; border: 1px solid #aaa" required>
        </div>
        <div id="stock-quantity"></div>
      </div>

        <div class="wrapper-action">
          <button class="btn-darken" onclick="addToCart()">Add to Cart</button>
        </div>

      <?php
        } else {
      ?>

      <div id="quantity-container">
        <div class="product-quantity">
          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $stock; ?>" style="padding: 3px; border: 1px solid #aaa" required>
        </div>
        <div id="stock-quantity">Stock: <?php echo $stock; ?></div>
      </div>

      <div class="wrapper-action">
        <button class="btn-darken" onclick="addToCart()">Add to Cart</button>
      </div>
      <?php
        }
      } else {
  
      if($cat == 'Necklaces' || $cat == 'Rings') {
      ?>
      <!-- Size Buttons --> 
      <div class="product-sizes">
      <button class="size-button" data-size="14" onclick="selectSize('14')">14</button>
      <button class="size-button" data-size="16" onclick="selectSize('16')">16</button>
      <button class="size-button" data-size="18" onclick="selectSize('18')">18</button>
      <button class="size-button" data-size="20" onclick="selectSize('20')">20</button>
      <button class="size-button" data-size="24" onclick="selectSize('24')">24</button>
      </div>

      <?php
        } else {}
      ?>
 
      <?php
      } 
      ?>
    </div>
  </div>
</div>

<!-- Comment Section -->
<div class="comment-section">
  <h3>Comments</h3>

  <?php
      if($login == 'logged_in') {
  ?>
  <!-- Comment Form -->
  <div class="comment-form">
    <form id="comment-form">
      <textarea name="comment" id="comment" placeholder="Write your comment here..." required></textarea>
      <button type="submit">Post Comment</button>
    </form>
  </div>
  <?php
      }else {
  ?>
  <!-- Comment Form -->
  <div class="comment-form">
    <form>
      <textarea name="comment" id="comment" placeholder="Create an account first before writing your comment here..." readonly></textarea>
      <button type="submit" disabled>Comment</button>
    </form>
  </div>
  <?php
      }
  ?>
  
  <!-- Display Comments -->
  <ul class="comments" id="comments-list" style="padding-top:5rem;">
    <?php
      // Fetch and display comments from the database
      $comments_query = "SELECT * FROM comment WHERE product_id='$product_id'";
      $result = mysqli_query($conn, $comments_query);
      while($row = mysqli_fetch_assoc($result)) {
        $author = htmlspecialchars($row['author']);
        $comment_text = htmlspecialchars($row['comment']);
        $created_at = htmlspecialchars($row['created_at']);
        echo "<li class='comment'><p class='author'>$author</p><p>$comment_text</p><p class='date'>$created_at</p></li>";
      }
    ?>
  </ul>
</div>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.js"></script>
<!-- Custom Script -->
<script>
    $(document).ready(function () {
        const commentsList = document.getElementById('comments-list');

        // Event listener for submitting a new comment (same as before)
        $('#comment-form').submit(function (event) {
            event.preventDefault();
            const commentTextarea = $('#comment');
            const commentText = commentTextarea.val().trim();

            if (commentText !== '') {
                $.ajax({
                    url: 'insert_comment.php',
                    type: 'POST',
                    data: { comment: commentText,
                            product_id: '<?php echo $product_id; ?>',
                            author: '<?php echo $fullname; ?>',
                            picture: '<?php echo $pic; ?>'
                          
                          },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            // If insertion is successful, append the new comment to the comments list
                            const commentItem = document.createElement('li');
                            commentItem.classList.add('media-block');
                            commentItem.innerHTML = `
                                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                                <div class="media-body">
                                    <div class="mar-btm">
                                        <a href="#" class="btn-link text-semibold media-heading box-inline">You</a>
                                        <p class="text-muted text-sm">Just now</p>
                                    </div>
                                    <p>${commentText}</p>
                                    <hr>
                                </div>`;
                            commentsList.prepend(commentItem); // prepend the new comment to display it on top

                            // Clear the comment textarea after submission
                            commentTextarea.val('');
                        } else {
                            alert('Failed to insert comment. Please try again later.');
                        }
                    },
                    error: function () {
                        alert('Failed to insert comment. Please try again later.');
                    }
                });
            }
        });
    });
</script>
<script>

let selectedSize = 0;

function updateAddToCartButton() {
  const addToCartButton = document.querySelector('.btn-darken');
  addToCartButton.disabled = selectedSize === '';
}

function updateAddToCartButton2() {
  const addToCartButton = document.querySelector('.btn-darken');
  const quantityInput = document.getElementById('quantity');
  addToCartButton.disabled = quantityInput.value === '' || parseInt(quantityInput.value) <= 0;
}


function selectSize(size) {
  selectedSize = size;

  // Remove active class from all size buttons
  const sizeButtons = document.querySelectorAll('.size-button');
  sizeButtons.forEach(button => {
    button.classList.remove('active');
  });

  // Add active class to the selected size button
  const selectedSizeButton = document.querySelector(`.size-button[data-size='${size}']`);
  if (selectedSizeButton) {
    selectedSizeButton.classList.add('active');
  }

  document.getElementById('selected-size').textContent = `Selected Size: ${size}`;
  document.getElementById('quantity-container').style.display = 'block'; // Show the quantity container
  updateAddToCartButton();
  
    // Make AJAX request to fetch stock quantity for the selected size
    fetch(`get_stock.php?product_id=<?php echo $product_id; ?>&size=${size}`)
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const maxStock = data.stock;
          document.getElementById('stock-quantity').textContent = `Stock: ${maxStock}`;
          // Set the maximum value of the quantity input field to the available stock
          document.getElementById('quantity').setAttribute('max', maxStock);
          // Reset the quantity input field value if it exceeds the available stock
          const quantityInput = document.getElementById('quantity');
          if (parseInt(quantityInput.value) > maxStock) {
            quantityInput.value = maxStock;
          }
        } else {
          console.error('Failed to fetch stock quantity');
        }
      })
      .catch(error => {
        console.error('Error fetching stock quantity:', error);
      });
  }

  function handleQuantityInput(event) {
    if (event.key === 'Enter') {
      const quantityInput = document.getElementById('quantity');
      const maxStock = parseInt(quantityInput.getAttribute('max'));
      const enteredQuantity = parseInt(quantityInput.value);
      if (enteredQuantity > maxStock) {
        quantityInput.value = maxStock;
      }
    }
  }

  function addToCart() {
    console.log('addToCart function is called.');
  const quantity = document.getElementById('quantity').value;

  if (quantity === '' || parseInt(quantity) <= 0) {
    alert('Please enter a valid quantity.');
    return;
  }

  if (selectedSize !== '') {
    // Proceed with adding the product to the cart with size
    window.location.href = `adtocart.php?products=<?php echo $title ?>&size=${selectedSize}&quantity=${quantity}`;
  } else {
    // Proceed with adding the product to the cart without size
    window.location.href = `adtocart.php?products=<?php echo $title ?>&quantity=${quantity}`;
  }
}



document.addEventListener('DOMContentLoaded', function() {
  const stars = document.querySelectorAll('.rate i');
  const productRating = document.getElementById('product-rating');
  const totalRatings = document.getElementById('total-ratings');
  const productId = '<?php echo $product_id; ?>'; // Fetch the productId from PHP
  const userEmail = '<?php echo $email; ?>'; // Fetch the email from PHP
  let userHasRated = false; // Variable to track whether the user has rated the product

  // Check if the user has already rated the product
  fetch('check_rating.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ productId, userEmail }), // Pass productId and userEmail in the body
  })
  .then(response => response.json())
  .then(data => {
    if (data.success && data.hasRated) {
      userHasRated = true;
      // Disable the rating functionality
      stars.forEach(star => {
        star.style.pointerEvents = 'none'; // Disable clicking on stars
      });
    }
  })
  .catch(error => {
    console.error('Error checking user rating:', error);
  });

  stars.forEach(star => {
    star.addEventListener('click', function() {
      if (!userHasRated) {
        const rating = parseInt(star.getAttribute('data-rating'));

        stars.forEach(s => {
          if (parseInt(s.getAttribute('data-rating')) <= rating) {
            s.classList.add('active');
          } else {
            s.classList.remove('active');
          }
        });

        // Update the total rating and total reviews using the response
        let [currentRating, totalReviews] = totalRatings.textContent.match(/(\d+\.\d+) \((\d+)\)/).slice(1);
        currentRating = parseFloat(currentRating);
        totalReviews = parseInt(totalReviews);

        // Calculate the new average rating
        const newRating = ((currentRating * totalReviews) + rating) / (totalReviews + 1);
        totalRatings.textContent = newRating.toFixed(1) + ' (' + (totalReviews + 1) + ')';

        // Send the rating to the server to be saved
        saveRating(productId, rating, userEmail); // Pass productId and userEmail to saveRating

        // Update userHasRated to prevent further rating
        userHasRated = true;

        // Disable the rating functionality
        stars.forEach(s => {
          s.style.pointerEvents = 'none'; // Disable clicking on stars
    });
  }
  });
    updateAddToCartButton();
    document.getElementById('quantity').addEventListener('keypress', handleQuantityInput);
    document.getElementById('quantity').addEventListener('input', updateAddToCartButton2);
    document.getElementById('quantity').addEventListener('focus', updateAddToCartButton2);
    
  });


  function saveRating(productId, rating, userEmail) {
    // Implement AJAX request to save the rating to the server
    fetch('save_ratings.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ productId, rating, userEmail }), // Pass productId and userEmail in the body
    })
    .then(response => {
      if (response.ok) {
        console.log('Rating saved successfully');
      } else {
        console.error('Failed to save rating');
      }
    })
    .catch(error => {
      console.error('Error saving rating:', error);
    });
  }
});
</script>

</body>
</html>