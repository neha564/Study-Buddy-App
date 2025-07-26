<?php
// Check if the 'status' parameter is set in the URL
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .message-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        .retry-btn {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .retry-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="message-container">
    <?php if ($status == 'cancelled'): ?>
        <h1>Payment Cancelled</h1>
        <p>Your payment has been cancelled successfully.</p>
        <button class="retry-btn" onclick="window.location.href='index.php';">Go Back to Home</button>
    <?php else: ?>
        <h1>Error</h1>
        <p>Invalid or missing status. Please try again later.</p>
    <?php endif; ?>
</div>

</body>
</html>

