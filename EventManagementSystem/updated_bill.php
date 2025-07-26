
<?php
// Fetching data sent from JavaScript in c1.html
$orderDetails = json_decode($_POST['orderDetails'], true);
$selectedItems = $orderDetails['selectedItems'];
$totalAmount = $orderDetails['totalAmount'];
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
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bill Summary</h1>
        <ul>
            <?php foreach ($selectedItems as $item): ?>
                <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="total">Total: ₹<?= htmlspecialchars($totalAmount) ?></div>
    </div>
</body>
</html>
