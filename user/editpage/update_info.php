<?php
session_start();
include("../../connect.php");
$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $update_sql = "UPDATE users SET fullname = '$fullname', email = '$email' WHERE id=$user_id";

    // อัพเดตข้อมูลในฐานข้อมูล
    if (mysqli_query($conn, $update_sql)) {
        header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>