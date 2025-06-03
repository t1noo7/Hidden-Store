<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($conn, $get_user);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    ?>
    <h3 class="text-success">All my Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="table-info">
            <tr>
                <th>S1 No</th>
                <th>Amount Due</th>
                <th>Total Products</th>
                <th>Invoice No</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_orders = "SELECT * FROM `user_orders` WHERE user_id='$user_id'";
            $result_orders = mysqli_query($conn, $get_orders);
            $number = 1;
            while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row_orders['order_id'];
                $amount_due = $row_orders['amount_due'];
                $total_products = $row_orders['total_products'];
                $invoice_number = $row_orders['invoice_number'];
                $order_date = $row_orders['order_date'];
                $order_status = $row_orders['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Incomplete';
                } else {
                    $order_status = 'Complete';
                }

                echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$total_products</td>
                        <td>$invoice_number</td>
                        <td>$order_date</td>
                        <td>$order_status</td>";
                ?>
                <?php
                if ($order_status == 'Complete') {
                    echo "<td class = 'text-success'><strong>Paid</strong></td>";
                } else {
                    echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                      </tr>";
                }
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>