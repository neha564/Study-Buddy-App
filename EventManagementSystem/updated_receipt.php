
<?php
// Fetching data from bill.php
$orderDetails = json_decode($_POST['orderDetails'], true);
$selectedItems = $orderDetails['selectedItems'];
$totalAmount = $orderDetails['totalAmount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
        }
        .print-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        .print-btn:hover {
            background: #0056b3;
        }
    </style>
    <script>
        function printReceipt() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Receipt</h1>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
            </tr>
            <?php foreach ($selectedItems as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item) ?></td>
                    <td>-</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="total">Total Amount: ₹<?= htmlspecialchars($totalAmount) ?></div>
        <button class="print-btn" onclick="printReceipt()">Print Receipt</button>
    </div>
</body>
</html>
