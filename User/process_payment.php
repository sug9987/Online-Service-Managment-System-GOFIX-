<?php
session_start();
include('../dbConnection.php');

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get request ID from session
    $request_id = $_SESSION['myid'] ?? 0;

    // Fetch requester email from submitrequest_tb
    $fetch_sql = "SELECT requester_email FROM submitrequest_tb WHERE request_id = ?";
    $fetch_stmt = $conn->prepare($fetch_sql);

    if ($fetch_stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    $fetch_stmt->bind_param("i", $request_id);
    $fetch_stmt->execute();
    $fetch_result = $fetch_stmt->get_result();

    if ($fetch_result->num_rows == 1) {
        $row = $fetch_result->fetch_assoc();
        $customer_email = $row['requester_email'];  // Store requester_email as customer_email
    } else {
        die("Error: Request ID not found.");
    }

    $fetch_stmt->close();

    // Get user input values
    $amount = $_POST['amount'] ?? 0;
    $transaction_id = $_POST['transaction_id'] ?? '';
    $card_number = $_POST['card_number'] ?? '';
    $expiry_date = $_POST['expiry_date'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Validate Amount
    if (!is_numeric($amount) || $amount <= 0) {
        echo "<script>alert('Invalid amount!'); history.back();</script>";
        exit;
    }

    // Validate Card Number (16 digits)
    if (!preg_match("/^\d{16}$/", $card_number)) {
        echo "<script>alert('Invalid Card Number! Must be 16 digits.'); history.back();</script>";
        exit;
    }

    // Validate CVV (3 digits)
    if (!preg_match("/^\d{3}$/", $cvv)) {
        echo "<script>alert('Invalid CVV! Must be 3 digits.'); history.back();</script>";
        exit;
    }

    // Store only last 4 digits of the card number for security
    $masked_card_number = substr($card_number, -4);

    // Simulating payment processing (Replace with actual payment gateway integration)
    $payment_status = "Success"; // Assume payment is successful

    // Insert payment details into the database
    $sql = "INSERT INTO payments (customer_email, amount, transaction_id, method, card_number, status) 
            VALUES (?, ?, ?, 'Card', ?, ?)";

    // Prepare SQL statement
    $stmt = $conn->prepare($sql);

    // Check if prepare() was successful
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    // Bind parameters to the SQL query
    $stmt->bind_param("sdsss", $customer_email, $amount, $transaction_id, $masked_card_number, $payment_status);

    // Execute the query and check if successful
    if ($stmt->execute()) {
        // Show a loading animation before redirecting
        echo "
            <html>
            <head>
                <style>
                    body {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background-color: #f8f9fa;
                        font-family: Arial, sans-serif;
                    }
                    .loading-container {
                        text-align: center;
                    }
                    .spinner {
                        border: 5px solid rgba(0, 0, 0, 0.1);
                        border-left-color: #007bff;
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        animation: spin 1s linear infinite;
                        margin: auto;
                    }
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .loading-text {
                        margin-top: 10px;
                        font-size: 18px;
                        color: #333;
                    }
                </style>
            </head>
            <body>
                <div class='loading-container'>
                    <div class='spinner'></div>
                    <p class='loading-text'>Processing Payment...</p>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = 'success.php?txn=" . urlencode($transaction_id) . "';
                    }, 3000);
                </script>
            </body>
            </html>
        ";
        exit;
    } else {
        echo "<script>alert('Payment Failed! Try Again.'); history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid Request!'); history.back();</script>";
}
?>
