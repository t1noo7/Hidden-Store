<?php
if (isset($_POST['user_login'])) {
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    @session_start();

    $user_username = mysqli_real_escape_string($conn, $_POST['user_username']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);

    // Check if the user exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    $select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($conn, $select_cart_query);
    $cart_row_count = mysqli_num_rows($select_cart);
    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($row_count == 1 && $cart_row_count == 0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successful!');</script>";
                echo "<script>window.open('profile.php', '_self');</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successful!');</script>";
                echo "<script>window.open('payment.php', '_self');</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials!');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form method="post">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" class="form-control"
                            placeholder="Enter your username..." autocomplete="off" required>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Passwprd</label>
                        <input type="password" id="user_password" name="user_password" class="form-control"
                            placeholder="Enter your password..." autocomplete="off" required>
                    </div>

                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php"
                                class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>