<?php
$conn = mysqli_connect("localhost", "root", "", "MyStore");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>