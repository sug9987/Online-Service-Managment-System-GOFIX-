<?php
define('TITLE', 'Success');
include('includes/header2.php');  // Ensure this file exists and is correctly named with .php extension
include('../dbConnection.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['is_login'])) {
    echo "<script> location.href='UserLogin.php'; </script>";
    exit;
}

$request_id = $_SESSION['myid'] ?? 0;  // Get request ID from session

// Fetch requester details
$fetch_sql = "SELECT requester_email, requester_name, request_info, request_desc FROM submitrequest_tb WHERE request_id = ?";
$fetch_stmt = $conn->prepare($fetch_sql);
$fetch_stmt->bind_param("i", $request_id);
$fetch_stmt->execute();
$fetch_result = $fetch_stmt->get_result();

if ($fetch_result->num_rows != 1) {
    echo "<div class='ml-5 mt-5'><p>Failed to retrieve request details.</p></div>";
    exit;
}

$request_data = $fetch_result->fetch_assoc();
$customer_email = $request_data['requester_email'];
$fetch_stmt->close();

// Fetch latest successful payment details for the requester
$payment_sql = "SELECT * FROM payments WHERE customer_email = ? AND status = 'Success' ORDER BY created_at DESC LIMIT 1";
$payment_stmt = $conn->prepare($payment_sql);
$payment_stmt->bind_param("s", $customer_email);
$payment_stmt->execute();
$payment_result = $payment_stmt->get_result();
$payment = $payment_result->fetch_assoc();
$payment_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        /* Container with margin from the left */
        .container {
            width: 100%;
            max-width: 800px;  /* Keeps the table from getting too wide */
            margin-left: 50px; /* Adds space between the content and the left side */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Button Styles */
        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* QR Code Styling */
        img {
            max-width: 100px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-success"></h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Request ID</th>
                    <td><?php echo $request_id; ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo htmlspecialchars($request_data['requester_name']); ?></td>
                </tr>
                <tr>
                    <th>Email ID</th>
                    <td><?php echo htmlspecialchars($customer_email); ?></td>
                </tr>
                <tr>
                    <th>Request Info</th>
                    <td><?php echo htmlspecialchars($request_data['request_info']); ?></td>
                </tr>
                <tr>
                    <th>Request Description</th>
                    <td><?php echo htmlspecialchars($request_data['request_desc']); ?></td>
                </tr>

                <?php if ($payment): ?>
                    <tr>
                        <th>Transaction ID</th>
                        <td><?php echo htmlspecialchars($payment['transaction_id']); ?></td>
                    </tr>
                    <tr>
                        <th>Amount Paid</th>
                        <td>₹<?php echo number_format($payment['amount'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td><?php echo htmlspecialchars($payment['status']); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td><?php echo htmlspecialchars(ucfirst($payment['method'])); ?></td>
                    </tr>
                    <?php if ($payment['method'] == "UPI" && !empty($payment['upi_id'])): ?>
                        <tr>
                            <th>UPI ID</th>
                            <td><?php echo htmlspecialchars($payment['upi_id']); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($payment['method'] == "QR" && !empty($payment['qr_code'])): ?>
                        <tr>
                            <th>QR Code</th>
                            <td><img src="<?php echo htmlspecialchars($payment['qr_code']); ?>" alt="QR Code"></td>
                        </tr>
                    <?php endif; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2"><b>No Successful Payment Found</b></td>
                    </tr>
                <?php endif; ?>

                <tr>
                    <td colspan="2">
                        <button class="btn" onclick="window.print()">Print</button>
                        <button class="btn btn-secondary" onclick="closeWindow()">Close</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        function closeWindow() {
            window.location.href = 'UserProfile.php';  // Redirect to the profile page when the close button is pressed
        }
    </script>
</body>
</html>

<?php include('includes/footer.php'); ?>
<?php $conn->close(); ?>
