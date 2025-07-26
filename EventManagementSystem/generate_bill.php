<?php
// Constants for GST and Discount Rates
define("GST_RATE", 0.18); // 18% GST
define("DISCOUNT_RATE", 0.1); // 10% Discount for large orders
define("DISCOUNT_THRESHOLD", 10); // Threshold for the number of guests to apply the discount

// Initialize variables
$selectedItems = [];
$totalAmount = 0;
$numberOfGuests = 1; // Default to 1 to avoid division by zero
$pricePerGuest = 0;
$discount = 0;
$gst = 0;
$finalTotal = 0;

// Handle form submission and order details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch order details
    if (isset($_POST['orderDetails'])) {
        $orderDetails = json_decode($_POST['orderDetails'], true);
        $selectedItems = isset($orderDetails['selectedItems']) ? $orderDetails['selectedItems'] : [];
        $totalAmount = isset($orderDetails['totalAmount']) ? (float)$orderDetails['totalAmount'] : 0;
    }
    
    // Fetch and validate the number of guests
    if (isset($_POST['numberOfGuests'])) {
        $numberOfGuests = max(1, (int)$_POST['numberOfGuests']); // Ensure at least 1 guest
    }

    // Calculate price per guest
    $pricePerGuest = $totalAmount * $numberOfGuests;

    // Apply discount if applicable
    $discount = ($numberOfGuests >= DISCOUNT_THRESHOLD) ? $totalAmount * DISCOUNT_RATE : 0;

    // Calculate total after discount
    $totalAfterDiscount = $totalAmount - $discount;

    // Add price per guest to the total
    $totalAfterDiscount += $pricePerGuest;

    // Calculate GST
    $gst = $totalAfterDiscount * GST_RATE;

    // Calculate final total
    $finalTotal = $totalAfterDiscount + $gst;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }
        li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }
        th {
            background-color: #f4f4f4;
        }
        .total-row th {
            font-size: 1.2em;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input {
            padding: 8px;
            width: 80px;
            text-align: center;
            font-size: 16px;
            margin-left: 10px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .print-btn {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            font-size: 1.1em;
            cursor: pointer;
            margin: 10px;
        }
        .print-btn:hover {
            background-color: #555;
        }
    </style>
    <script>
        function printBill() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Bill Summary</h1>
        <ul>
            <?php if (!empty($selectedItems)): ?>
                <?php foreach ($selectedItems as $item): ?>
                    <li><?= htmlspecialchars($item) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No items selected.</li>
            <?php endif; ?>
        </ul>

        <!-- Guest Count Form -->
        <form method="POST">
            <input type="hidden" name="orderDetails" value='<?= htmlspecialchars(json_encode(['selectedItems' => $selectedItems, 'totalAmount' => $totalAmount])) ?>'>
            <div class="form-group">
                <label for="numberOfGuests">Number of Guests:</label>
                <input type="number" name="numberOfGuests" id="numberOfGuests" value="<?= $numberOfGuests ?>" min="1" required>
                <button type="submit">Recalculate</button>
            </div>
        </form>

        <!-- Bill Details -->
        <table>
            <tr>
                <th>Description</th>
                <th>Amount (₹)</th>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td><?= number_format($totalAmount, 2) ?></td>
            </tr>
            <tr>
                <td>Number of Guests</td>
                <td><?= $numberOfGuests ?></td>
            </tr>
            <tr>
                <td>Price Per Guest</td>
                <td><?= number_format($pricePerGuest, 2) ?></td>
            </tr>
            <tr>
                <td>Discount (<?= DISCOUNT_RATE * 100 ?>% for <?= DISCOUNT_THRESHOLD ?>+ guests)</td>
                <td>- <?= number_format($discount, 2) ?></td>
            </tr>
            <tr>
                <td>GST (<?= GST_RATE * 100 ?>%)</td>
                <td><?= number_format($gst, 2) ?></td>
            </tr>
            <tr class="total-row">
                <th>Final Total</th>
                <th><?= number_format($finalTotal, 2) ?></th>
            </tr>
        </table>

        <!-- Pay Now Button -->
        <button style="background-color: #007bff; color: white; font-size: 16px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <a href="pay_catering.php?total_amount=<?= urlencode($finalTotal); ?>" style="color: white; text-decoration: none;">Pay Now</a>
        </button>
    </div>
</body>
</html>

