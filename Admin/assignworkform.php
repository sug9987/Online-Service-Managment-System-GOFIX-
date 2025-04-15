<?php 
// Start session
if (session_id() == '') {
    session_start();
}

// Check if admin is logged in
if (!isset($_SESSION['is_adminlogin'])) {
    echo "<script> location.href='adminlogin.php' </script>";
    exit;
}

// Include database connection
include('../dbConnection.php');

// Fetch request details if "view" button is clicked
if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // Fetch payment details based on requester's email
    $payment_sql = "SELECT transaction_id, method, status FROM payments WHERE customer_email = ? ORDER BY created_at DESC LIMIT 1";
    $payment_stmt = $conn->prepare($payment_sql);
    $payment_stmt->bind_param("s", $row['requester_email']);
    $payment_stmt->execute();
    $payment_result = $payment_stmt->get_result();
    $payment = $payment_result->fetch_assoc();
    $payment_stmt->close();
}

// Delete request if "close" button is clicked
if (isset($_REQUEST['close'])) {
    $sql = "DELETE FROM submitrequest_tb WHERE request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_REQUEST['id']);
    if ($stmt->execute()) {
        echo '<meta http-equiv="refresh" content="0; URL=?closed" />';
    } else {
        echo "Unable to Delete";
    }
    $stmt->close();
}

// Assign work if "assign" button is clicked
if (isset($_REQUEST['assign'])) {
    // Check for empty fields
    if (empty($_REQUEST['request_id']) || empty($_REQUEST['request_info']) || empty($_REQUEST['requestdesc']) ||
        empty($_REQUEST['requestername']) || empty($_REQUEST['address1']) || empty($_REQUEST['address2']) ||
        empty($_REQUEST['requestercity']) || empty($_REQUEST['requesterstate']) || empty($_REQUEST['requesterzip']) ||
        empty($_REQUEST['requesteremail']) || empty($_REQUEST['requestermobile']) || empty($_REQUEST['assigntech']) ||
        empty($_REQUEST['inputdate']) || empty($_REQUEST['transaction_id']) || empty($_REQUEST['payment_status']) || empty($_REQUEST['payment_method'])) {
        
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        // Insert work assignment along with payment details
        $sql = "INSERT INTO assignwork_tb (request_id, request_info, request_desc, requester_name, 
        requester_add1, requester_add2, requester_city, requester_state, requester_zip, 
        requester_email, requester_mobile, assign_tech, assign_date, payment_status, payment_method, transaction_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssssssss",
            $_REQUEST['request_id'], $_REQUEST['request_info'], $_REQUEST['requestdesc'],
            $_REQUEST['requestername'], $_REQUEST['address1'], $_REQUEST['address2'],
            $_REQUEST['requestercity'], $_REQUEST['requesterstate'], $_REQUEST['requesterzip'],
            $_REQUEST['requesteremail'], $_REQUEST['requestermobile'], $_REQUEST['assigntech'],
            $_REQUEST['inputdate'], $_REQUEST['payment_status'], $_REQUEST['payment_method'],
            $_REQUEST['transaction_id']
        );

        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Work Assigned Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Assign Work</div>';
        }
        $stmt->close();
    }
}
?>

<div class="col-sm-5 mt-5 jumbotron">
  <form action="" method="POST">
    <h5 class="text-center">Assign Work Order Request</h5>
    
    <!-- Request ID -->
    <div class="form-group">
      <label for="request_id">Request ID</label>
      <input type="text" class="form-control" id="request_id" name="request_id" 
      value="<?php if(isset($row['request_id'])) echo $row['request_id'];?>" readonly>
    </div>

    <!-- Request Info -->
    <div class="form-group">
      <label for="request_info">Request Info</label>
      <input type="text" class="form-control" id="request_info" name="request_info"
      value="<?php if(isset($row['request_info'])) echo $row['request_info'];?>">
    </div>

    <!-- Description -->
    <div class="form-group">
      <label for="requestdesc">Description</label>
      <input type="text" class="form-control" id="requestdesc" name="requestdesc"
      value="<?php if(isset($row['request_desc'])) echo $row['request_desc'];?>">
    </div>

    <div class="form-group">
      <label for="requestername">Name</label>
      <input type="text" class="form-control" id="requestername" name="requestername" value="<?php if(isset($row['requester_name'])) { echo $row['requester_name']; } ?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="address1">Address Line 1</label>
        <input type="text" class="form-control" id="address1" name="address1" value="<?php if(isset($row['requester_add1'])) { echo $row['requester_add1']; } ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="address2">Address Line 2</label>
        <input type="text" class="form-control" id="address2" name="address2" value="<?php if(isset($row['requester_add2'])) {echo $row['requester_add2']; }?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="requestercity">City</label>
        <input type="text" class="form-control" id="requestercity" name="requestercity" value="<?php if(isset($row['requester_city'])) {echo $row['requester_city']; }?>">
      </div>
      <div class="form-group col-md-4">
        <label for="requesterstate">State</label>
        <input type="text" class="form-control" id="requesterstate" name="requesterstate" value="<?php if(isset($row['requester_state'])) { echo $row['requester_state']; } ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="requesterzip">Zip</label>
        <input type="text" class="form-control" id="requesterzip" name="requesterzip" value="<?php if(isset($row['requester_zip'])) { echo $row['requester_zip']; } ?>"
          onkeypress="isInputNumber(event)">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-8">
        <label for="requesteremail">Email</label>
        <input type="email" class="form-control" id="requesteremail" name="requesteremail" value="<?php if(isset($row['requester_email'])) {echo $row['requester_email']; }?>">
      </div>
      <div class="form-group col-md-4">
        <label for="requestermobile">Mobile</label>
        <input type="text" class="form-control" id="requestermobile" name="requestermobile" value="<?php if(isset($row['requester_mobile'])) {echo $row['requester_mobile']; }?>"
          onkeypress="isInputNumber(event)">
      </div>
    </div>
    <!-- Payment Details -->
    <div class="form-group">
      <label for="transaction_id">Transaction ID</label>
      <input type="text" class="form-control" id="transaction_id" name="transaction_id" 
      value="<?php if(isset($payment['transaction_id'])) echo $payment['transaction_id']; ?>" readonly>
    </div>

    <div class="form-group">
      <label for="payment_method">Payment Method</label>
      <input type="text" class="form-control" id="payment_method" name="payment_method"
      value="<?php if(isset($payment['method'])) echo $payment['method']; ?>" readonly>
    </div>

    <div class="form-group">
      <label for="payment_status">Payment Status</label>
      <input type="text" class="form-control" id="payment_status" name="payment_status"
      value="<?php if(isset($payment['status'])) echo $payment['status']; ?>" readonly>
    </div>

    <!-- Assign Technician -->
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="assigntech">Assign to Technician</label>
        <input type="text" class="form-control" id="assigntech" name="assigntech">
      </div>

      <!-- Date -->
      <div class="form-group col-md-4">
        <label for="inputDate">Date</label>
        <input type="date" class="form-control" id="inputDate" name="inputdate">
      </div>
    </div>

    <!-- Submit Buttons -->
    <div class="float-right">
        <button type="submit" class="btn btn-success" name="assign">Assign</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
  
  <?php if(isset($msg)) {echo $msg;}?>
</div>

<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
