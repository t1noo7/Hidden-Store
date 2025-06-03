<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');
include('../functions/common_functions.php');

if (isset($_POST['user_register'])) {
    $user_username = trim($_POST['user_username']);
    $user_email = trim($_POST['user_email']);
    $user_image = $_FILES['user_image']['name'];
    $temp_image = $_FILES['user_image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = trim($_POST['user_address']);
    $user_contact = trim($_POST['user_contact']);
    $user_ip = getIPAddress();

    if ($user_password !== $conf_user_password) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    // Kiểm tra username/email trùng
    $check_query = "SELECT * FROM user_table WHERE username='$user_username' AND user_email='$user_email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username or email already exists!');</script>";
        exit();
    }

    move_uploaded_file($temp_image, "./user_images/$user_image");
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO user_table (username, user_email, user_image, user_password, user_address, user_phone, user_ip) 
                     VALUES ('$user_username', '$user_email', '$user_image', '$hashed_password', '$user_address', '$user_contact', '$user_ip')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        echo "<script>alert('Registered successfully!');</script>";
        echo "<script>window.location.href = 'user_login.php';</script>";
    } else {
        $error = mysqli_error($conn);
        echo "<script>alert('Registration failed. Error: " . addslashes($error) . "');</script>";
    }

    $select_cart_items = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
    $cart_result = mysqli_query($conn, $select_cart_items);
    $count_cart_items = mysqli_num_rows($cart_result);
    if ($count_cart_items > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart.');</script>";
        echo "<script>window.location.href = 'checkout.php';</script>";
    } else {
        echo "<script>alert('No items in cart.');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">Register new account</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" class="form-control"
                            placeholder="Enter username..." autocomplete="off" required>
                        <small class="form-text text-muted fst-italic">Unique name to log in</small>
                        <div id="username-status" class="mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" name="user_email" class="form-control"
                            placeholder="Enter email..." autocomplete="off" required>
                        <small class="form-text text-muted fst-italic">We will not share your email</small>
                        <div id="email-status" class="mt-1"></div>
                    </div>

                    <div class="mb-3">
                        <label for="user_image" class="form-label">Avatar</label>
                        <input type="file" id="user_image" name="user_image" class="form-control" required>
                        <small class="form-text text-muted fst-italic">Select image format .jpg, .png,...</small>
                    </div>

                    <div class="mb-3">
                        <label for="user_password" class="form-label">Passwprd</label>
                        <input type="password" id="user_password" name="user_password" class="form-control"
                            placeholder="Enter password..." required>
                    </div>

                    <div class="mb-3">
                        <label for="conf_user_password" class="form-label">Confirm password</label>
                        <input type="password" id="conf_user_password" name="conf_user_password" class="form-control"
                            placeholder="Re-enter password..." required>
                    </div>

                    <div class="mb-3">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" name="user_address" class="form-control"
                            placeholder="Enter address..." autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_contact" class="form-label">Phone No.</label>
                        <input type="text" id="user_contact" name="user_contact" class="form-control"
                            placeholder="Enter Phone No..." autocomplete="off" required>
                    </div>

                    <div class="mt-4 text-center">
                        <input type="submit" value="Register" class="btn btn-info px-4" name="user_register">
                        <p class="small mt-3">Already have an account? <a href="user_login.php"
                                class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#user_username').on('blur', function () {
                var username = $(this).val();

                if (username !== '') {
                    $.ajax({
                        url: '../functions/common_functions.php',
                        method: 'POST',
                        data: {
                            action: 'checkUsername',
                            username: username
                        },
                        success: function (response) {
                            if (response.trim() === 'taken') {
                                $('#username-status').html('<span class="text-danger">Tên đăng nhập đã tồn tại</span>');
                            } else {
                                $('#username-status').html('<span class="text-success">Tên đăng nhập hợp lệ</span>');
                            }
                        }
                    });
                } else {
                    $('#username-status').html('');
                }
            });
            //check email
            $('#user_email').on('blur', function () {
                var email = $(this).val();

                if (email !== '') {
                    $.ajax({
                        url: '../functions/common_functions.php',
                        method: 'POST',
                        data: {
                            action: 'checkEmail',
                            email: email
                        },
                        success: function (response) {
                            if (response.trim() === 'taken') {
                                $('#email-status').html('<span class="text-danger">Email đã tồn tại</span>');
                            } else {
                                $('#email-status').html('<span class="text-success">Email hợp lệ</span>');
                            }
                        }
                    });
                } else {
                    $('#email-status').html('');
                }
            });
        });
    </script>
</body>

</html>