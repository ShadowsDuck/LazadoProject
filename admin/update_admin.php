<?php
session_start();
include('../connect.php');

// รับข้อมูลจากฟอร์ม
$id = mysqli_real_escape_string($conn, $_POST['id']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);

// อัปเดตรายละเอียด admin โดยไม่เปลี่ยนรหัสผ่าน
$sql = "UPDATE users SET username = '$username', fullname = '$fullname' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = "Record updated successfully";
    header("Location: {$base_url}/admin/manage_admin.php");
} else {
    $_SESSION['message'] = "Error updating record: " . mysqli_error($conn);
    header("Location: {$base_url}/admin/manage_admin.php");
}

mysqli_close($conn);
