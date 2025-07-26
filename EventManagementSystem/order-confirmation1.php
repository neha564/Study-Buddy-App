<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 50px;
        }
        .confirmation {
            background-color: #f4b41a;
            padding: 20px;
            color: white;
            font-size: 1.2em;
        }
        #back-button, #generate-bill-button {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            font-size: 1.1em;
            cursor: pointer;
            margin: 10px;
        }
        #back-button:hover, #generate-bill-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="confirmation">
        <h1>Order Confirmation</h1>
        <p id="order-details"></p>
    </div>
    <button id="back-button" onclick="window.history.back()">Back to Menu</button>
    <form method="POST" action="generate_bill.php">
        <input type="hidden" name="orderDetails" id="hidden-order-details">
        <button type="submit" id="generate-bill-button">Generate Bill</button>
    </form>

    <script>
        // Retrieve and parse the order details from localStorage
        const orderDetails = localStorage.getItem('orderDetails');
        
        if (orderDetails) {
            const parsedOrder = JSON.parse(orderDetails);
            const selectedItems = parsedOrder.selectedItems.join('<br>'); // Convert items to string with line breaks
            const totalAmount = parsedOrder.totalAmount;
            document.getElementById('order-details').innerHTML = `You have selected:<br>${selectedItems}<br><br><strong>Total Amount: ₹${totalAmount}</strong>`;
            document.getElementById('hidden-order-details').value = orderDetails; // Pass data to PHP
        } else {
            document.getElementById('order-details').textContent = 'No order found.';
        }
    </script>
</body>
</html>

