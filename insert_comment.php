<?php
// Include your database connection file
include 'db_conn.php';

// Check if the comment text is set and not empty
if (isset($_POST['comment']) && !empty($_POST['comment'])) {
    // Escape the comment text to prevent SQL injection
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $product_id = $_POST['product_id'];
    $name = $_POST['author'];
    $pic = $_POST['picture'];
    
    // Insert the comment into the database
    $insert_query = "INSERT INTO comment (product_id, author, profilepic, comment, created_at) VALUES ('$product_id', '$name', '$pic', '$comment', NOW())";
    if (mysqli_query($conn, $insert_query)) {
        // If insertion is successful, return success response
        echo json_encode(array("status" => "success"));
    } else {
        // If insertion fails, return error response
        echo json_encode(array("status" => "error", "message" => "Failed to insert comment"));
    }
} else {
    // If comment text is not set or empty, return error response
    echo json_encode(array("status" => "error", "message" => "Comment text is required"));
}
?>
