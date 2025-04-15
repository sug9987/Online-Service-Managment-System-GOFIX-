<?php
define('TITLE', 'Payment Success');
define('PAGE', 'SubmitRequest');
include('includes/header1.php'); 
include('../dbConnection.php');
session_start();

// Check if the payment ID exists and is verified
if (!isset($_SESSION['verified_payment'])) {
    die("Unauthorized access.");
}

// Get the verified payment ID
$payment_id = $_SESSION['verified_payment'];
unset($_SESSION['verified_payment']); // Unset to prevent re-use

// Fetch payment details from the database
$sql = "SELECT * FROM payments WHERE transaction_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $payment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    die("Payment record not found.");
}

// Fetch requester details from the database
$request_id = $_SESSION['myid'];
$sql = "SELECT requester_name, requester_email, request_info, request_desc FROM submitrequest_tb WHERE request_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $request_id);
$stmt->execute();
$request_result = $stmt->get_result();
$request = $request_result->fetch_assoc();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .checkmark-circle {
            width: 80px;
            height: 80px;
            background: #28a745;
            color: white;
            font-size: 50px;
            line-height: 80px;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 15px;
        }

        .transaction-card {
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            font-size: 16px;
            margin-top: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .value {
            color: #222;
        }

        .status {
            font-weight: bold;
            color: #28a745;
        }

        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;
        }

        .redirect-text {
            margin-top: 15px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="checkmark-circle">✔</div>
        <h2>Payment Successful 🎉</h2>

        <?php if ($row && $request): ?>
            <div class="transaction-card">
                <div class="row">
                    <span class="label">👤 Name:</span>
                    <span class="value"><?php echo htmlspecialchars($request['requester_name']); ?></span>
                </div>
                <div class="row">
                    <span class="label">✉️ Email:</span>
                    <span class="value"><?php echo htmlspecialchars($request['requester_email']); ?></span>
                </div>
                <div class="row">
                    <span class="label">🔹 Transaction ID:</span>
                    <span class="value"><?php echo htmlspecialchars($row['transaction_id']); ?></span>
                </div>
                <div class="row">
                    <span class="label">💰 Amount Paid:</span>
                    <span class="value">₹<?php echo number_format($row['amount'], 2); ?></span>
                </div>
                <div class="row">
                    <span class="label">🟢 Payment Status:</span>
                    <span class="value status"><?php echo htmlspecialchars($row['status']); ?></span>
                </div>
                <div class="row">
                    <span class="label">💳 Payment Method:</span>
                    <span class="value"><?php echo htmlspecialchars($row['method']); ?></span>
                </div>
            </div>
        <?php else: ?>
            <p>Transaction details not found.</p>
        <?php endif; ?>

        <div class="redirect-text">
            <!-- The Continue button now manually redirects to the submitrequestsuccess.php page -->
            <button class="btn" onclick="window.location.href='submitrequestsuccess.php';">Continue</button>
        </div>
    </div>

</body>
</html>

<?php
include('includes/footer.php'); 
$conn->close();
?>
