<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the total amount from the GET request
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : 0;

// Check if the total amount is provided
if ($total_amount > 0) {
    // Format the display message for the total amount
    $payment_message = "Total Amount: ₹" . number_format($total_amount, 2);
} else {
    // Show an error message if the total amount is missing
    $payment_message = "Error: Total amount is missing!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        /* Basic styling for the payment page */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .price {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .payment-methods {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .payment-methods button {
            padding: 12px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .payment-methods button:hover {
            background-color: #0056b3;
        }

        .payment-methods button:active {
            background-color: #004085;
        }

        .payment-details {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .payment-details.active {
            display: block;
        }

        .payment-details input, .payment-details select {
            margin: 10px 0;
            padding: 8px;
            width: 100%;
            font-size: 16px;
        }

        .payment-details button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-details button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Make a Payment</h2>

    <!-- Display the total amount -->
    <div class="price">
        <p><?php echo $payment_message; ?></p>
    </div>

    <!-- Payment Methods -->
    <?php if ($total_amount > 0): ?>
        <div class="payment-methods">
            <button onclick="showPaymentDetails('credit-card')">Pay with Credit/Debit Card</button>
            <button onclick="showPaymentDetails('net-banking')">Pay with Net Banking</button>
            <button onclick="showPaymentDetails('upi')">Pay with UPI</button>
        </div>
    <?php else: ?>
        <p>Please provide the total amount to proceed with the payment.</p>
    <?php endif; ?>

    <!-- Payment Details Section -->
    <div id="credit-card" class="payment-details">
        <h3>Credit/Debit Card Details</h3>
        <input type="text" placeholder="Card Number" required>
        <input type="text" placeholder="Cardholder Name" required>
        <input type="month" placeholder="Expiry Date" required>
        <input type="text" placeholder="CVV" required>
        <button onclick="processPayment('credit-card')">Pay Now</button>
    </div>

    <div id="net-banking" class="payment-details">
        <h3>Net Banking</h3>
        <select required>
            <option value="">Select Bank</option>
            <option value="sbi">State Bank of India</option>
            <option value="hdfc">HDFC Bank</option>
            <option value="icici">ICICI Bank</option>
            <option value="axis">Axis Bank</option>
        </select>
        <button onclick="processPayment('net-banking')">Proceed to Pay</button>
    </div>

    <div id="upi" class="payment-details">
        <h3>UPI Payment</h3>
        <input type="text" placeholder="Enter UPI ID" required>
        <button onclick="processPayment('upi')">Pay Now</button>
    </div>
</div>

<script>
    // Function to show the corresponding payment details section
    function showPaymentDetails(paymentMethod) {
        // Hide all payment details sections
        document.querySelectorAll('.payment-details').forEach(function (section) {
            section.classList.remove('active');
        });

        // Show the selected payment details section
        document.getElementById(paymentMethod).classList.add('active');
    }

    // Function to process payment and redirect to success page
    function processPayment(paymentMethod) {
        const totalAmount = "<?php echo $total_amount; ?>";

        // Redirect to pay_success.php with payment details
        window.location.href = `pay_success.php?payment_method=${paymentMethod}&total_amount=${totalAmount}`;
    }
</script>
</body>
</html>

