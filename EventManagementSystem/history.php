<?php
// Include the database connection
include('db_connection.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if a delete request is received
if (isset($_GET['delete_booking_id'])) {
    $delete_booking_id = intval($_GET['delete_booking_id']); // Sanitize input

    if ($delete_booking_id > 0) {
        // Prepare the delete query
        $delete_query = "DELETE FROM bookings WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_query);

        if ($stmt_delete) {
            $stmt_delete->bind_param('i', $delete_booking_id);

            if ($stmt_delete->execute()) {
                header("Location: booking_history.php?delete_success=true");
                exit;
            } else {
                echo "Error executing delete query: " . $conn->error;
                exit;
            }
        } else {
            echo "Error preparing delete query: " . $conn->error;
            exit;
        }
    } else {
        echo "Invalid booking ID.";
        exit;
    }
}

// Query to fetch all bookings and payment details
$query = "
    SELECT 
        bookings.id AS booking_id,
        bookings.event_name,
        bookings.venue,
        bookings.date AS event_date,
        bookings.start_time,
        bookings.end_time,
        bookings.details AS event_details,
        COALESCE(bookings.user_name, 'Not Provided') AS user_name,
        COALESCE(bookings.user_email, 'Not Provided') AS user_email,
        COALESCE(bookings.user_phone, 'Not Provided') AS user_phone,
        COALESCE(payments.payment_method, 'Not Paid') AS payment_method,
        COALESCE(payments.payment_status, 'None') AS payment_status,
        COALESCE(payments.payment_amount, 0) AS payment_amount,
        COALESCE(payments.payment_date, NULL) AS payment_date
    FROM bookings
    LEFT JOIN payments ON bookings.id = payments.booking_id
    ORDER BY bookings.date DESC, payments.payment_date DESC;
";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}
if (!$stmt->execute()) {
    die("Query execution failed: " . $conn->error);
}
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 10000px;
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
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .status-success {
            color: green;
        }
        .status-failed {
            color: red;
        }
        .status-pending {
            color: orange;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Your Booking History</h2>

    <!-- Display success or error message -->
    <?php if (isset($_GET['delete_success'])): ?>
        <div class="alert alert-success">Booking deleted successfully!</div>
    <?php elseif (isset($_GET['delete_error'])): ?>
        <div class="alert alert-error">Error deleting booking. Please try again.</div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Event Name</th>
                    <th>Venue</th>
                    <th>Event Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['venue']); ?></td>
                        <td><?php echo date("F j, Y", strtotime($row['event_date'])); ?></td>
                        <td><?php echo date("g:i a", strtotime($row['start_time'])); ?></td>
                        <td><?php echo date("g:i a", strtotime($row['end_time'])); ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($row['payment_method'])); ?></td>
                        <td class="status-<?php echo strtolower($row['payment_status'] ?? 'none'); ?>">
                            <?php echo htmlspecialchars(ucfirst($row['payment_status'] ?? 'None')); ?>
                        </td>
                        <td>₹<?php echo number_format($row['payment_amount'], 2); ?></td>
                        <td><?php echo $row['payment_date'] ? date("F j, Y, g:i a", strtotime($row['payment_date'])) : 'Not Available'; ?></td>
                        <td>
                            <a href="booking_history.php?delete_booking_id=<?php echo $row['booking_id']; ?>" 
                               class="delete-btn" 
                               onclick="return confirm('Are you sure you want to delete this booking?')">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>

