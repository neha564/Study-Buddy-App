<?php
// Start session if needed
session_start();

// Fetch the payment details from the URL
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : 0;
$payment_method = isset($_GET['payment_method']) ? $_GET['payment_method'] : 'Unknown';

// Event name based on booking details (this can be dynamic, for example from a database)
$event_name = "Sample Event";  // Replace with dynamic event name from your database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        /* CSS for making the receipt look professional */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }

        .details {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .details .bold {
            font-weight: bold;
        }

        .buttons-container {
            text-align: center;
        }

        .print-btn, .cancel-btn {
            display: inline-block;
            width: 200px;
            margin: 10px;
            padding: 12px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-btn {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .print-btn:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h1>Payment Successful</h1>
    
    <div class="details">
        <p><span class="bold">Total Amount Paid:</span> ₹<?php echo htmlspecialchars($total_amount); ?></p>
        <p><span class="bold">Payment Method:</span> <?php echo htmlspecialchars(ucfirst(str_replace('-', ' ', $payment_method))); ?></p>
        <p><span class="bold">Payment Status:</span> Success</p>
    </div>

    <div class="buttons-container">
        <button class="print-btn" onclick="window.print()">Print Receipt</button>
        <button class="cancel-btn" onclick="window.location.href='payment_cancelled.php?status=cancelled';">Cancel Payment</button>
    </div>
</div>

</body>
</html>

