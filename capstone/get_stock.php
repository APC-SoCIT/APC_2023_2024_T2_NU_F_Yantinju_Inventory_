<?php
// Include your database connection file here
include 'db_conn.php';

// Check if the product ID and size are provided in the request
if(isset($_GET['product_id']) && isset($_GET['size'])) {
    $product_id = $_GET['product_id'];
    $size = $_GET['size'];

    // Prepare and execute a query to retrieve the stock quantity for the selected size and product ID
    $query = "SELECT stock FROM `size` WHERE id='$product_id' AND size='$size'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if($result) {
        // Fetch the stock quantity from the result
        $row = mysqli_fetch_assoc($result);
        $stock = $row['stock'];

        // Return the stock quantity as JSON
        echo json_encode(['success' => true, 'stock' => $stock]);
        exit;
    } else {
        // If the query fails, return an error message
        echo json_encode(['success' => false, 'message' => 'Failed to fetch stock quantity']);
        exit;
    }
} else {
    // If the product ID or size is not provided, return an error message
    echo json_encode(['success' => false, 'message' => 'Product ID or size not provided']);
    exit;
}
?>
