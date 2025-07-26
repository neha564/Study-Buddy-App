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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="fed.css">
    <script>
        // Set the rating based on the clicked star
        function setRating(rating) {
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('filled');
                } else {
                    star.classList.remove('filled');
                }
            });

            // Update the hidden rating input with the selected rating value
            document.getElementById('ratingValue').value = rating;
        }
    </script>
</head>
<body>
    <div class="form-container">
        <?php if ($formSubmitted): ?>
            <h2>Feedback Submitted Successfully!</h2>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Rating:</strong> <?php echo $rating; ?>/5</p>
            <p><strong>Your Message:</strong> <?php echo nl2br($message); ?></p>
        <?php else: ?>
            <h1>Feedback Form</h1>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <div class="rating">
                        <span class="star" onclick="setRating(1)">&#9733;</span>
                        <span class="star" onclick="setRating(2)">&#9733;</span>
                        <span class="star" onclick="setRating(3)">&#9733;</span>
                        <span class="star" onclick="setRating(4)">&#9733;</span>
                        <span class="star" onclick="setRating(5)">&#9733;</span>
                        <input type="hidden" name="rating" id="ratingValue" value="0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Your Feedback</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

