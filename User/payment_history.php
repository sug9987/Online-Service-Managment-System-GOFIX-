<?php
session_start();
define('TITLE', 'Payment History');
define('PAGE', 'Payment History');

include('includes/header1.php');
include('../dbConnection.php');

// Initialize search variables
$searchQuery = "";
$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = trim($_POST['searchQuery']);

    if (!empty($searchQuery)) {
        // Search by Transaction ID OR Customer Email
        $sql = "SELECT transaction_id, customer_email, amount, method, status, created_at 
                FROM payments 
                WHERE transaction_id = ? OR customer_email LIKE CONCAT('%', ?, '%')";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $searchQuery, $searchQuery);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            die("Query Error: " . $conn->error);
        }
    } else {
        // Show all payments if no search input
        $sql = "SELECT transaction_id, customer_email, amount, method, status, created_at FROM payments ORDER BY created_at DESC";
        $result = $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <style>
        /* Centering Search Box */
        .search-container {
            max-width: 500px; /* Medium-sized search bar */
            margin: auto;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        /* Adding space between the search bar and the button */
        .input-group input {
            margin-right: 10px; /* Space between the input field and the button */
        }

        /* Badge Styling */
        .badge-success {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .badge-warning {
            background-color: #ffc107;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
    <script>
        function printPaymentHistory() {
            var printContent = document.getElementById('printTable').innerHTML;
            var originalContent = document.body.innerHTML;
            
            document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printContent + "</body></html>";
            window.print();
            location.reload(); // Reload to fix styling after print
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Search Payment History</h2>

    <!-- Search Form -->
    <form method="POST" action="" class="mb-4 search-container">
        <div class="input-group">
            <input type="text" name="searchQuery" class="form-control" placeholder="Enter Transaction ID or Customer Email" value="<?php echo htmlspecialchars($searchQuery); ?>" required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Display Results -->
    <?php if ($result !== null && $result->num_rows > 0): ?>
        <div id="printTable">
            <h3 class="text-center">Payment History</h3>
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Transaction ID</th>
                        <th>Customer Email</th>
                        <th>Amount (₹)</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                            <td>₹<?php echo number_format($row['amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['method']); ?></td>
                            <td>
                                <?php
                                $status = $row['status'];
                                $badgeClass = ($status == "Success") ? "badge-success" : (($status == "Failed") ? "badge-danger" : "badge-warning");
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($status); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Print Button -->
        <div class="text-center mt-3">
            <button onclick="printPaymentHistory()" class="btn btn-success">Print Payment History</button>
        </div>

    <?php else: ?>
        <p class="text-center text-danger">No payment records found.</p>
    <?php endif; ?>

</div>

</body>
</html>

<?php
include('includes/footer.php'); 
$conn->close();
?>  
