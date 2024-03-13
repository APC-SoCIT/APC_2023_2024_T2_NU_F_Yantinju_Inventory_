<?php
include "db_conn";
// Check if the form was submitted with a file upload
if (isset($_FILES['payment_proof'])) {
    $uploadDir = 'images/payment_proofs/'; // Directory where payment proof images will be saved
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif'); // Allowed file extensions

    $fileName = $_FILES['payment_proof']['name'];
    $fileTmpName = $_FILES['payment_proof']['tmp_name'];
    $fileSize = $_FILES['payment_proof']['size'];
    $fileError = $_FILES['payment_proof']['error'];

    // Extract file extension
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file extension is allowed
    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique filename to avoid overwriting existing files
        $newFileName = uniqid('proof_') . '.' . $fileExtension;
        $uploadPath = $uploadDir . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // File uploaded successfully, perform any additional actions (e.g., update database)
            // For demonstration purposes, let's just echo the filename
            echo $newFileName;
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'Invalid file extension. Allowed extensions are: ' . implode(', ', $allowedExtensions);
    }
} else {
    echo 'No file uploaded.';
}
?>
