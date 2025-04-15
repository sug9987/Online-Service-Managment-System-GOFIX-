<?php
define('TITLE', 'Payment');
define('PAGE', 'SubmitRequest');
include('includes/header1.php'); 
include('../dbConnection.php');
session_start();

if (!isset($_SESSION['myid'])) {
    echo "<script> location.href='SubmitRequest.php'; </script>";
    exit;
}

require('../vendor/autoload.php'); // Razorpay SDK
use Razorpay\Api\Api;

// Razorpay Credentials
$keyId = "rzp_test_lhEgzeStBlj2i7";  // Replace with your Razorpay Key ID
$keySecret = "uzMRnnkKCcK3nfl9rshRkvBu";  // Replace with your Razorpay Secret Key
$api = new Api($keyId, $keySecret);

// Fetch Requester Details
$myid = $_SESSION['myid'];
$sql = "SELECT requester_name, requester_email FROM submitrequest_tb WHERE request_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $myid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rname = $row['requester_name'];
    $remail = $row['requester_email'];
    $amount = 9900; // Amount in paise (99 INR)
} else {
    echo "<script> alert('Requester details not found!'); location.href='SubmitRequest.php'; </script>";
    exit;
}

// Create Razorpay Order
$orderData = [
    'amount' => $amount,
    'currency' => 'INR',
    'receipt' => "ORD" . $_SESSION['myid'],
    'payment_capture' => 1 // Auto capture payment
];

try {
    $order = $api->order->create($orderData);
    $_SESSION['order_id'] = $order['id'];
} catch (Exception $e) {
    die('Razorpay Error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }
        .content {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: auto;
            margin-right: auto;
        }
        .payment-card {
            width: 100%;
            max-width: 600px;
            min-height: 400px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
            padding: 30px;
            background: #ffffff;
            border-radius: 15px;
            text-align: left;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .btn-pay {
            background-color: #28a745;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }
        .btn-pay:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            width: 100%; /* Full width for the label */
            text-align: left;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .form-group .form-control {
            width: 100%; /* Full width for input field */
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .form-group input {
            text-align: left; /* Align text to left */
        }
    </style>
</head>
<body>

<div class="content">
    <div class="payment-card">
        <h2 class="mb-4 text-center font-weight-bold">Requester Information</h2>
        <div class="card-body">
            <div class="form-group">
                <label for="name"><strong>Name:</strong></label>
                <input type="text" id="name" class="form-control" value="<?php echo htmlspecialchars($rname); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($remail); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="amount"><strong>Amount:</strong></label>
                <input type="text" id="amount" class="form-control" value="₹<?php echo number_format($amount / 100, 2); ?>" readonly>
            </div>
            <button id="pay-btn" class="btn-pay">Pay Now</button>
        </div>
    </div>
</div>

<!-- Razorpay Payment Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "<?php echo $keyId; ?>",
        "amount": "<?php echo $amount; ?>", // amount in paise
        "currency": "INR",
        "name": "GOFIX",
        "description": "Service Payment",
        "image": "https://yourwebsite.com/logo.png", // Replace with your logo
        "order_id": "<?php echo $_SESSION['order_id']; ?>",
        "handler": function (response) {
            // Redirect to verify_payment.php with payment_id
            window.location.href = "verify_payment.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo htmlspecialchars($rname); ?>",
            "email": "<?php echo htmlspecialchars($remail); ?>"
        },
        "theme": {
            "color": "#28a745"
        }
    };

    document.getElementById("pay-btn").onclick = function () {
        var rzp1 = new Razorpay(options);
        rzp1.open();
    };
</script>

</body>
</html>

<?php
include('includes/footer.php'); 
$conn->close();
?>
