<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the total amount from the GET request
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : 0;

// Check if the total amount is provided
if ($total_amount) {
    // Show the total price details
    $price_message = "Total Amount: ₹" . number_format($total_amount, 2);
} else {
    // If the parameter is missing, show an error message
    $price_message = "Error: Missing total amount!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Payment Page</title>
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
            font-size: 18px;
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

        .payment-form {
            display: none;
            margin-top: 20px;
        }

        .payment-form input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .payment-form button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Catering Payment</h2>

    <!-- Display Total Price -->
    <div class="price">
        <p><?php echo $price_message; ?></p>
    </div>

    <!-- Payment Methods -->
    <?php if ($total_amount): ?>
        <div class="payment-methods">
            <button onclick="showPaymentForm('credit-card')">Credit/Debit Card</button>
            <button onclick="showPaymentForm('net-banking')">Net Banking</button>
            <button onclick="showPaymentForm('upi')">UPI</button>
        </div>

        <!-- Credit/Debit Card Payment Form -->
        <div id="credit-card-form" class="payment-form">
            <h3>Enter Card Details</h3>
            <input type="text" id="card-number" placeholder="Card Number" />
            <input type="text" id="expiry-date" placeholder="Expiry Date (MM/YY)" />
            <input type="text" id="cvv" placeholder="CVV" />
            <button onclick="processPayment('credit-card')">Pay with Credit/Debit Card</button>
        </div>

        <!-- Net Banking Payment Form -->
        <div id="net-banking-form" class="payment-form">
            <h3>Select Bank</h3>
            <select id="bank-name">
                <option value="">Select Bank</option>
                <option value="bank1">Indian Overseas Bank</option>
                <option value="bank2">State Bank of India</option>
                <option value="bank3">ICICI Bank</option>
            </select>
            <button onclick="processPayment('net-banking')">Pay with Net Banking</button>
        </div>

        <!-- UPI Payment Form -->
        <div id="upi-form" class="payment-form">
            <h3>Choose UPI Payment Method</h3>
            <button onclick="payWithUPI('google-pay')">Pay with Google Pay</button>
            <button onclick="payWithUPI('phone-pe')">Pay with PhonePe</button>
        </div>
    <?php else: ?>
        <p>Please provide the necessary details to complete the payment.</p>
    <?php endif; ?>

</div>

<script>
    // Function to show the corresponding payment form based on the selected method
    function showPaymentForm(paymentMethod) {
        // Hide all payment forms
        document.getElementById('credit-card-form').style.display = 'none';
        document.getElementById('net-banking-form').style.display = 'none';
        document.getElementById('upi-form').style.display = 'none';

        // Show the selected payment method form
        if (paymentMethod === 'credit-card') {
            document.getElementById('credit-card-form').style.display = 'block';
        } else if (paymentMethod === 'net-banking') {
            document.getElementById('net-banking-form').style.display = 'block';
        } else if (paymentMethod === 'upi') {
            document.getElementById('upi-form').style.display = 'block';
        }
    }

    // Function to process payments
    function processPayment(paymentMethod) {
        const totalAmount = "<?php echo $total_amount; ?>";

        if (paymentMethod === 'credit-card') {
            const cardNumber = document.getElementById('card-number').value;
            const expiryDate = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;

            if (cardNumber && expiryDate && cvv) {
                window.location.href = "payment_success.php?payment_method=credit-card&total_amount=" + totalAmount;
            } else {
                alert('Please fill in all the card details');
            }
        } else if (paymentMethod === 'net-banking') {
            const bankName = document.getElementById('bank-name').value;

            if (bankName) {
                window.location.href = "payment_success.php?payment_method=net-banking&total_amount=" + totalAmount;
            } else {
                alert('Please select a bank');
            }
        }
    }

    // Function to handle UPI payments
    function payWithUPI(upiMethod) {
        const totalAmount = "<?php echo $total_amount; ?>";
        window.location.href = "payment_success.php?payment_method=" + upiMethod + "&total_amount=" + totalAmount;
    }
</script>

</body>
</html>

