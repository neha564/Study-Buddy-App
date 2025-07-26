<?php
// db_connection.php

$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "event_booking"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error (in production environments)
    error_log("Connection failed: " . $conn->connect_error);
    
    // Display a user-friendly message
    die("Sorry, something went wrong. Please try again later.");
}

// Connection successful, you can now interact with the database

// Close the connection when done
// $conn->close();
?>

