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

// Initialize variables
$booking_id = $event_name = $total_price = "";
$error = "";

// Fetch booking details based on the ID passed in the URL
if (isset($_GET['id'])) {
    $booking_id = $_GET['id']; // Get booking ID from the URL
} else {
    die("Booking ID is not provided.");
}

// Fetch booking data from the database
$sql = "SELECT * FROM bookings WHERE id = $booking_id";
$result = $conn->query($sql);

// Check if the booking was found
if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();
    $event_name = $booking['event_name'];
    $total_price = $booking['total_price']; // Example: total_price is calculated in the database
} else {
    die("Booking not found.");
}

// Razorpay API Key (Replace with your own credentials)
$razorpay_key_id = "YOUR_RAZORPAY_KEY_ID";
$razorpay_secret_key = "YOUR_RAZORPAY_SECRET_KEY";

// Handle payment request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];

    if ($payment_method == "razorpay") {
        // Razorpay order creation
        $order_data = [
            'receipt' => rand(1000, 9999),
            'amount' => $total_price * 100, // Amount in paise
            'currency' => 'INR',
            'payment_capture' => 1,
        ];

        // Initialize cURL to call Razorpay's order creation API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $razorpay_key_id . ':' . $razorpay_secret_key);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($order_data));

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the response from Razorpay
        $response_data = json_decode($response, true);

        // Check if the order was created successfully
        if (isset($response_data['id'])) {
            $order_id = $response_data['id'];

            // Send the order ID and payment information to the frontend
            echo "<script src='https://checkout.razorpay.com/v1/checkout.js'></script>";
            echo "
            <script>
                var options = {
                    key: '$razorpay_key_id',
                    amount: '$total_price' * 100, // Amount in paise
                    currency: 'INR',
                    name: '$event_name',
                    description: 'Event Booking Payment',
                    image: 'https://your-logo-url.com',
                    order_id: '$order_id',
                    handler: function(response) {
                        alert('Payment Successful');
                        // You can also redirect to a success page with payment details
                        window.location.href = 'payment_success.php?payment_id=' + response.razorpay_payment_id + '&order_id=' + '$order_id';
                    },
                    modal: {
                        ondismiss: function() {
                            alert('Payment process cancelled!');
                        }
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            </script>";
        } else {
            $error = "Error creating Razorpay order. Please try again.";
        }

    } elseif ($payment_method == "upi") {
        // Handle UPI Payment here (redirect to UPI payment app)
        echo "<script>alert('UPI Payment selected. Proceed to your UPI app to complete payment.');</script>";

    } elseif ($payment_method == "credit_card") {
        // Handle Credit/Debit Card Payment via Razorpay or other gateway
        echo "<script>alert('Credit/Debit Card Payment selected. Please provide your card details on the payment gateway page.');</script>";

    } elseif ($payment_method == "wallet") {
        // Handle Wallet Payment here (Example: PhonePe, Paytm)
        echo "<script>alert('Wallet Payment selected. Please proceed with your wallet app to complete payment.');</script>";

    } else {
        $error = "Invalid payment method selected.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Payment</title>
    <style>
        /* Styles for the payment page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .price {
            font-size: 20px;
            margin-top: 10px;
            text-align: center;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
        .payment-btn {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border: none;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .payment-btn:hover {
            background-color: #0056b3;
        }
        .payment-options {
            margin-top: 20px;
        }
        .payment-options label {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Complete Your Payment</h2>

        <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>

        <p><strong>Event:</strong> <?php echo $event_name; ?></p>
        <p><strong>Total Price:</strong> ₹<?php echo $total_price; ?></p>

        <form method="POST">
            <div class="payment-options">
                <label><input type="radio" name="payment_method" value="razorpay" required> Razorpay (Cards, UPI, Wallets)</label>
                <label><input type="radio" name="payment_method" value="upi" required> UPI Payment</label>
                <label><input type="radio" name="payment_method" value="credit_card" required> Credit/Debit Card</label>
                <label><input type="radio" name="payment_method" value="wallet" required> Wallet Payment (PhonePe, Paytm, etc.)</label>
            </div>

            <input type="submit" value="Pay Now" class="payment-btn">
        </form>
    </div>

</body>
</html>

