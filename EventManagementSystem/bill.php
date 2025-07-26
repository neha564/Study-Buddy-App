<?php
// Event Types and Prices (in Rupees)
$event_types = [
    'Wedding' => 5000.00,
    'Birthday Party' => 3000.00,
    'Conference' => 7500.00,
    'Corporate Event' => 10000.00,
    'Anniversary' => 6000.00,
    'Private Party' => 4000.00
];

// Initialize variables
$selected_event_type = '';
$guests_count = 0;
$event_date = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $selected_event_type = $_POST['event_type'];
    $guests_count = (int) $_POST['guests_count'];
    $event_date = $_POST['event_date'];

    // Redirect to receipt.php with data
    header("Location: receipt.php?event_type=$selected_event_type&guests_count=$guests_count&event_date=$event_date");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management - Bill Receipt</title>
    <style>
        /* Global Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Container Styles */
        .container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        h1 {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        /* Form Styles */
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 20px;
        }

        /* Label Styles */
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Input Styles */
        select, input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Submit Button Styles */
        button.submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 15px 25px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        /* Submit Button Hover Styles */
        button.submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Event Catering Bill Receipt</h1>

    <!-- Form for event selection and billing -->
    <form method="post" action="">
        <div class="form-group">
            <label for="event_type">Event Type:</label>
            <select name="event_type" id="event_type" required>
                <option value="">Select Event Type</option>
                <?php foreach ($event_types as $event_type => $price): ?>
                    <option value="<?= $event_type ?>" <?= $selected_event_type == $event_type ? 'selected' : '' ?>>
                        <?= $event_type ?> (₹<?= number_format($price, 2) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="guests_count">Number of Guests:</label>
            <input type="number" name="guests_count" id="guests_count" value="<?= $guests_count ?>" required>
        </div>

        <div class="form-group">
            <label for="event_date">Event Date:</label>
            <input type="date" name="event_date" id="event_date" value="<?= $event_date ?>" required>
        </div>

        <button type="submit" class="submit-btn">Generate Receipt</button>
    </form>
</div>

</body>
</html>






