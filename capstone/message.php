<?php
// getting user message through ajax
include "db_conn.php";

function fetchKeywordsFromDatabase($conn) {
    $keywords = array();

    $sql = "SELECT keyword, response FROM chatbot";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $keywords[$row["keyword"]] = $row["response"];
        }
    }

    return $keywords;
}

// Function to process user input and generate a response
function processInput($text, $keywords) {
    // Convert the input to lowercase for case-insensitive matching
    $input = strtolower($text);

    // Iterate through the keywords to find a match
    foreach ($keywords as $keyword => $response) {
        // Check if the input contains the keyword
        if (strpos($input, $keyword) !== false) {
            // If a keyword is found, return the corresponding response
            return $response;
        }
    }

    return "I'm sorry, I didn't understand your question.";
}

// Retrieve keyword-action pairs from the database
$keywords = fetchKeywordsFromDatabase($conn);

// Check if the 'text' parameter is set in the POST request
if (isset($_POST['text'])) {
    $userInput = $_POST['text'];

    // Process the input and generate a response
    $response = processInput($userInput, $keywords);

    // Return the response
    echo $response;
} else {
    // If 'text' parameter is not set, return an error message
    echo "Error: 'text' parameter is missing.";
}

// Close the database connection
$conn->close();
?>