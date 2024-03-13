<?php
// Include your database connection file here
include 'db_conn.php';

// Get the data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$rating = $data['rating'];
$userEmail = $data['userEmail']; // Change to 'userEmail' to match the key in JavaScript

// Example query to insert the rating into the database
$insertQuery = "INSERT INTO ratings (product_id, rating, name) VALUES ('$productId', '$rating', '$userEmail')";

// Execute the query
if(mysqli_query($conn, $insertQuery)) {
  echo json_encode(array("status" => "success"));
} else {
  echo json_encode(array("status" => "error"));
}

// Close the database connection
mysqli_close($conn);
?>
