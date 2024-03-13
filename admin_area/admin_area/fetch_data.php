<?php
session_start();
include "db_conn.php";

// Check if the month parameter is set
if(isset($_GET['month'])) {
    // Sanitize and validate the month parameter
    $selected_month = intval($_GET['month']);
    if($selected_month < 1 || $selected_month > 12) {
        // Invalid month value, handle error (e.g., return empty data)
        echo json_encode([]);
        exit();
    }

    // Construct the start and end dates for the selected month
    $start_date = date('Y-m-01', strtotime("{$selected_month}/01"));
    $end_date = date('Y-m-t', strtotime("{$selected_month}/01"));
    
    // Construct the start and end dates for the previous month, aligned with the current month's dates
    $previous_month_start = date('Y-m-01', strtotime("-1 month", strtotime($start_date)));
    $previous_month_end = date('Y-m-t', strtotime("-1 month", strtotime($end_date)));

    // Query to fetch sales data for the selected month
    $get_sales_query = "SELECT DATE(DateTime) as day, SUM(kinita) as sales
                        FROM `sales`
                        WHERE DateTime BETWEEN '{$start_date}' AND '{$end_date}'
                        GROUP BY DATE(DateTime)";
    
    // Query to fetch sales data for the previous month, aligned with the current month's dates
    $get_previous_month_sales_query = "SELECT DATE(DateTime) as day, SUM(kinita) as sales
                                       FROM `sales`
                                       WHERE DateTime BETWEEN '{$previous_month_start}' AND '{$previous_month_end}'
                                       GROUP BY DATE(DateTime)";

    $result = $conn->query($get_sales_query);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        // Format the date
        $formatted_date = date("j", strtotime($row['day']));
        // Append the formatted date to the row
        $row['day'] = $formatted_date;
        $data[] = $row;
    }

    $previous_month_data = array();
    $previous_month_result = $conn->query($get_previous_month_sales_query);
    while ($row = $previous_month_result->fetch_assoc()) {
        // Format the date
        $formatted_date = date("j", strtotime($row['day']));
        // Append the formatted date to the row
        $row['day'] = $formatted_date;
        $previous_month_data[] = $row;
    }

    $combined_data = [
        'current_month' => $data,
        'previous_month' => $previous_month_data
    ];

    
    // Convert data to JSON and output
    echo json_encode($combined_data);
} else {
    // No month parameter provided, return empty data
    echo json_encode([]);
}

// Close connection
$conn->close();
?>
