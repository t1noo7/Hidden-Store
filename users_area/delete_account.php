<h3 class="text-danger mb-4">Delete Account</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Don't Delete Account">
    </div>
</form>

<?php
$username_session = $_SESSION['username'];
if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
    $result = mysqli_query($conn, $delete_query);
    if ($result) {
        session_destroy();
        echo "<script>alert('Account deleted successfully')</script>";
        echo "<script>window.open('../index.php', '_self')</script>";
    } else {
        echo "<script>alert('Error deleting account')</script>";
    }
}

if (isset($_POST['dont_delete'])) {
    echo "<script>alert('Account deletion cancelled')</script>";
    echo "<script>window.open('./profile.php', '_self')</script>";
}
?>