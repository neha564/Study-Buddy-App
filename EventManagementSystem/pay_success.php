<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the total amount and payment method from the GET request
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : 0;
$payment_method = isset($_GET['payment_method']) ? $_GET['payment_method'] : 'Unknown';

// Format a success message
$payment_message = $total_amount > 0 
    ? "Payment of ₹" . number_format($total_amount, 2) . " was successful!"
    : "Payment Successful!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 3em;
            color: #28a745;
            margin: 0 0 20px;
        }

        p {
            font-size: 1.2em;
            margin: 10px 0 20px;
            color: #333;
        }

        .payment-method {
            font-weight: bold;
        }

        .btn-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        button, a {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-print {
            background-color: #343a40;
        }

        .btn-print:hover {
            background-color: #495057;
        }

        .btn-home {
            background-color: #007bff;
        }

        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Payment Successful!</h1>
        <p><?= htmlspecialchars($payment_message) ?></p>
        <p>Payment Method: <span class="payment-method"><?= htmlspecialchars($payment_method) ?></span></p>
        
        <div class="btn-container">
            <button class="btn-print" onclick="printPage()">Print Receipt</button>
            <a href="generate_bill.php" class="btn-home">Back to Home</a>
        </div>
    </div>
</body>
</html>

