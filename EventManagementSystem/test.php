<?php
// Include the database connection
include('db_connection.php');

// Test the connection by running a simple query
$query = "
    SELECT 
        bookings.id AS booking_id,
        bookings.event_name,
        bookings.venue,
        bookings.date AS event_date,
        bookings.start_time,
        bookings.end_time,
        bookings.details AS event_details,
        bookings.user_name,
        bookings.user_email,
        bookings.user_phone,
        bookings.videography,
        bookings.photography,
        payments.payment_method,
        payments.payment_status,
        payments.payment_amount,
        payments.payment_date
    FROM bookings
    LEFT JOIN payments ON bookings.id = payments.booking_id
    ORDER BY bookings.date DESC, payments.payment_date DESC;
";

// Prepare and execute the query
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $result = $stmt->get_result();
} else {
    echo "Error executing query: " . $stmt->error;
    exit();
}

// Debugging: Check the number of rows and the result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<pre>';
        print_r($row);  // Print raw data for debugging
        echo '</pre>';
    }
} else {
    echo "No bookings found.";
}

// Close the database connection
$stmt->close();
$conn->close();
?>

