<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get event ID from the URL
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

// Fetch event details
$sql = "SELECT * FROM event_bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $event = $result->fetch_assoc();
    echo "<h1>" . htmlspecialchars($event['event_name']) . "</h1>";
    echo "<p><strong>Venue:</strong> " . htmlspecialchars($event['venue']) . "</p>";
    echo "<p><strong>Price:</strong> ₹" . htmlspecialchars($event['price']) . "</p>";
    echo "<p><strong>Date:</strong> " . htmlspecialchars($event['date']) . "</p>";
    echo "<p><strong>Start Time:</strong> " . htmlspecialchars($event['start_time']) . "</p>";
    echo "<p><strong>End Time:</strong> " . htmlspecialchars($event['end_time']) . "</p>";
    echo "<p><strong>Details:</strong> " . htmlspecialchars($event['other_details']) . "</p>";
} else {
    echo "<p>Event not found.</p>";
}

$conn->close();
?>
