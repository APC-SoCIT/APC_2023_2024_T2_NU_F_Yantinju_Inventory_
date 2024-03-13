<?php
// Include your database connection file here
include 'db_conn.php';

// Retrieve the productId and userEmail from the request body
$data = json_decode(file_get_contents("php://input"));
$productId = $data->productId;
$userEmail = $data->userEmail;

// Initialize the response array
$response = array();

// Check if the user has rated the product
$checkRatingQuery = "SELECT COUNT(*) AS rating_count FROM ratings WHERE product_id='$productId' AND name='$userEmail'";
$result = mysqli_query($conn, $checkRatingQuery);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $ratingCount = $row['rating_count'];

    // If the user has rated the product, set hasRated to true in the response
    $response['success'] = true;
    $response['hasRated'] = ($ratingCount > 0) ? true : false;
} else {
    // If an error occurs, set success to false in the response
    $response['success'] = false;
    $response['message'] = "Failed to check user rating";
}

// Send the JSON response
header('Content-type: application/json');
echo json_encode($response);
?>
