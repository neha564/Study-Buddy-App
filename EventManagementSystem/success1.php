<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $booking_id = $_GET['id']; // Get the booking ID from the URL

    // Fetch booking details
    $sql = "SELECT * FROM bookings WHERE id = $booking_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        die("Booking not found.");
    }
} else {
    die("Booking ID is not provided.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        .button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Booking Confirmation</h2>
    <p><strong>Event:</strong> <?php echo $booking['event_name']; ?></p>
    <p><strong>Venue:</strong> <?php echo $booking['venue']; ?></p>
    <p><strong>Date:</strong> <?php echo $booking['date']; ?></p>
    <p><strong>Start Time:</strong> <?php echo $booking['start_time']; ?></p>
    <p><strong>End Time:</strong> <?php echo $booking['end_time']; ?></p>

    <p><strong>Total Price:</strong> ₹<?php echo $total_price; ?></p>

    <!-- Pay Now Button -->
    <a href="payment_page.php?id=<?php echo $booking['id']; ?>&amount=<?php echo $total_price; ?>" class="button">Pay Now</a>
</div>

</body>
</html>

