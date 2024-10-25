<?php
session_start();
include('../connect.php');

// รับข้อมูลจากฟอร์ม
$id = mysqli_real_escape_string($conn, $_POST['id']);
$status = mysqli_real_escape_string($conn, $_POST['order_status']);

// อัปเดตรายละเอียด admin โดยไม่เปลี่ยนรหัสผ่าน
$sql = "UPDATE orders SET status = '$status' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = "Record updated successfully";
    header("Location: {$base_url}/admin/manage_order.php");
} else {
    $_SESSION['message'] = "Error updating record: " . mysqli_error($conn);
    header("Location: {$base_url}/admin/manage_order.php");
}

mysqli_close($conn);
