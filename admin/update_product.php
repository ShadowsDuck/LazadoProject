<?php
session_start();
include('../connect.php');

// รับข้อมูลจากฟอร์ม
$id = mysqli_real_escape_string($conn, $_POST['id']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

// ตรวจสอบและจัดการอัปโหลดไฟล์ภาพ
$img = '';
if (!empty($_FILES['img']['name'])) {
    $target_dir = "../uploads/";
    $img = basename($_FILES["img"]["name"]);
    $target_file = $target_dir . $img;
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
}

// ตรวจสอบว่ามีภาพใหม่ไหม เพื่อกำหนด SQL ให้เหมาะสม
$sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', category = '$category'";

if ($img) {
    $sql .= ", img = '$img'";
}

$sql .= " WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['message'] = "Record updated successfully";
    header("Location: {$base_url}/admin/manage_product.php");
} else {
    $_SESSION['message'] = "Error updating record: " . mysqli_error($conn);
    header("Location: {$base_url}/admin/manage_product.php");
}

mysqli_close($conn);
