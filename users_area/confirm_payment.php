<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $result_data = mysqli_query($conn, $select_data);
    $row_data = mysqli_fetch_assoc($result_data);
    $amount_due = $row_data['amount_due'];
    $invoice_number = $row_data['invoice_number'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $insert_query = "INSERT INTO `user_payments` (invoice_number, amount, payment_method, order_id) 
                     VALUES ('$invoice_number', '$amount', '$payment_method', '$order_id')";
    $result_query = mysqli_query($conn, $insert_query);
    if ($result_query) {
        echo "<script>alert('Successfully completed the payment!')</script>";
        $update_query = "UPDATE `user_orders` SET order_status='Complete' WHERE order_id=$order_id";
        $result_update = mysqli_query($conn, $update_query);
        echo "<script>window.open('profile.php?my_orders', '_self')</script>";
    } else {
        echo "<script>alert('Payment confirmation failed. Please try again.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <h1 class="text-center text-light">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number ?>"
                    name="invoice_number" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" value="<?php echo $amount_due ?>" name="amount"
                    readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_method" class="form-select w-50 m-auto">
                    <option value="">Select Payment Mode</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank transfer">Bank Transfer</option>
                    <option value="cash on delivery">Cash on Delivery</option>
                    <option value="upi">UPI</option>
                    <option value="payoffline">Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>

</html>