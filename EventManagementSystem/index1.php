<?php
session_start();

// If not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p>You are successfully logged in.</p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
