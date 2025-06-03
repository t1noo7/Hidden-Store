<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_address = $row['user_address'];
    $user_phone = $row['user_phone'];

    if (isset($_POST['user_update'])) {
        $update_id = $user_id;
        $user_address = $_POST['user_address'];
        $user_phone = $_POST['user_phone'];
        $user_image = $_FILES['user_image']['name'];
        $temp_image = $_FILES['user_image']['tmp_name'];

        if ($user_image) {
            move_uploaded_file($temp_image, "./user_images/$user_image");
            $update_query = "UPDATE `user_table` SET user_address='$user_address', user_phone='$user_phone', user_image='$user_image' WHERE user_id='$user_id'";
        } else {
            $update_query = "UPDATE `user_table` SET user_address='$user_address', user_phone='$user_phone' WHERE user_id='$user_id'";
        }

        $result_update = mysqli_query($conn, $update_query);
        if ($result_update) {
            echo "<script>alert('User details updated successfully')</script>";
            echo "<script>window.open('profile.php?edit_account','_self')</script>";
        } else {
            echo "<script>alert('Error updating user details')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>

<body>
    <h3 class="text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username"
                disabled>
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email"
                disabled>
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_images/<?php echo $user_image ?>" alt="" class="edit_img">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_phone ?>" name="user_phone">
        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3" name="user_update">
    </form>
</body>

</html>