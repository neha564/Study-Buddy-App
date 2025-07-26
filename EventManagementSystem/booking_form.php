<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit;
}

// Capture the price from the URL
$price = isset($_GET['price']) ? $_GET['price'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: purple;
            background-size: cover;
            color: pink;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .form-container {
            width: 50%;
            margin: 60px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
        }

        h3 {
            color: #FF5733; /* New color for h3 elements */
            font-size: 24px; /* Optional: Adjust font size if needed */
            margin-top: 30px;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="time"], textarea, select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="form-container">
        <h2>Book Your Event</h2>

        <form action="success.php" method="POST">
            <div class="input-group">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required>
            </div>
            <div class="input-group">
                <label for="venue">Venue:</label>
                <input type="text" id="venue" name="venue" required>
            </div>
            <div class="input-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="input-group">
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" required>
            </div>
            <div class="input-group">
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" required>
            </div>
            <div class="input-group">
                <label for="price">Price:</label>
                <!-- Hidden field for price -->
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>" />
                <!-- Display price -->
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" readonly />
            </div>

            <h3>Additional Services</h3>
            <div class="input-group">
                <label for="photography">Photography:</label>
                <input type="checkbox" id="photography" name="photography" value="1" />
                <span>₹300</span>
            </div>
            <div class="input-group">
                <label for="videography">Videography:</label>
                <input type="checkbox" id="videography" name="videography" value="1" />
                <span>₹500</span>
            </div>

            <h3>Your Details</h3>
            <div class="input-group">
                <label for="user_name">Name:</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>
            <div class="input-group">
                <label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" required>
            </div>
            <div class="input-group">
                <label for="user_phone">Phone:</label>
                <input type="tel" id="user_phone" name="user_phone" required>
            </div>

            <input type="submit" value="Book Now">
        </form>
    </div>

</body>
</html>

