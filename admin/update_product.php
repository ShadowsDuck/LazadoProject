<?php
session_start();
include('../connect.php');

// รับข้อมูลจากฟอร์ม
$id = mysqli_real_escape_string($conn, $_POST['id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$discount = mysqli_real_escape_string($conn, $_POST['discount']);
$discounted_price = mysqli_real_escape_string($conn, $_POST['discounted_price']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

// ตรวจสอบและจัดการอัปโหลดไฟล์ภาพ
$fileName = '';
if (!empty($_FILES['file']['name'])) {
    $target_dir = "../uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $fileName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
}

// ตรวจสอบว่ามีภาพใหม่ไหม เพื่อกำหนด SQL ให้เหมาะสม
$sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', discount = '$discount', discounted_price = '$discounted_price', category = '$category'";

if ($fileName) {
    $sql .= ", file_name = '$fileName'";
}

$sql .= " WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = "อัปเดตสินค้าสำเร็จแล้ว!";
    header("Location: {$base_url}/admin/manage_product.php");
} else {
    $_SESSION['message'] = "อัปเดตสินค้าไม่สำเร็จ!" . mysqli_error($conn);
    header("Location: {$base_url}/admin/manage_product.php");
}

mysqli_close($conn);
