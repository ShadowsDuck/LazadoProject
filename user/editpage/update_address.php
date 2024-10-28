<?php
session_start();
include("../../connect.php");
$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $update_sql = "UPDATE users SET address = '$address' WHERE id=$user_id";

    // อัพเดตข้อมูลในฐานข้อมูล
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['update_status_address'] = 'success';
        header("Location:{$base_url}/user/user_edit.php?page=infoEdit");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
