<?php
session_start();
include('../connect.php');

// รับข้อมูลจากฟอร์ม
$id = mysqli_real_escape_string($conn, $_POST['id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$price = mysqli_real_escape_string($conn, $_POST['price']);

$sql = "UPDATE products SET name = '$name', price = '$price' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = "Record updated successfully";
    header("Location: {$base_url}/admin/manage_product.php");
} else {
    $_SESSION['message'] = "Error updating record: " . mysqli_error($conn);
    header("Location: {$base_url}/admin/manage_product.php");
}

mysqli_close($conn);
