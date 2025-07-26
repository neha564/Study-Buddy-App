   <?php
// Fetch the price from the form submission
$price = isset($_POST['price']) ? $_POST['price'] : 0;
$photography_price = 300;
$videography_price = 500;
$photography = isset($_POST['photography']) ? $_POST['photography'] : 0;
$videography = isset($_POST['videography']) ? $_POST['videography'] : 0;

// Calculate total price
$total_price = $price;
if ($photography) {
    $total_price += $photography_price;
}
if ($videography) {
    $total_price += $videography_price;
}

// Assume this is the booking ID generated after booking (it should be fetched from your database)
$booking_id = 123;  // This booking ID should be dynamically generated after the booking is processed

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            text-align: center;
        }

        h1 {
            color: green;
            font-size: 24px;
            margin-top: 20px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            display: inline-block;
            margin: 20px 10px;
            padding: 15px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Booking Successful!</h1>
    <p>Thank you for booking your event with us. Here are your booking details:</p>

    <table>
        <tr><th>Item</th><th>Price</th></tr>
        <tr><td>Event Price</td><td>₹<?= $price ?></td></tr>
        <?php if ($photography): ?>
            <tr><td>Photography</td><td>₹<?= $photography_price ?></td></tr>
        <?php endif; ?>
        <?php if ($videography): ?>
            <tr><td>Videography</td><td>₹<?= $videography_price ?></td></tr>
        <?php endif; ?>
        <tr><td><strong>Total Price</strong></td><td><strong>₹<?= $total_price ?></strong></td></tr>
    </table>

    <h2>Click below to complete your payment:</h2>
    <!-- Updated link to include the booking ID and total amount -->
    <a href="payment_page.php?id=<?= $booking_id ?>&total_amount=<?= $total_price ?>" class="btn">Pay Now</a>
</body>
</html>
