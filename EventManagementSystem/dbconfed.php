<?php
// Database connection variables
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "feedback_system";

// Initialize rating to an empty value
$rating = 0;
$formSubmitted = false;

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the feedback and rating from the form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $rating = htmlspecialchars($_POST['rating']);

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $rating, $message);

    if ($stmt->execute()) {
        $formSubmitted = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

