<?php
session_start();
include('../connect.php');

// ตรวจสอบว่ามีการส่งข้อมูล POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // ตรวจสอบว่ามีการเลือกหมวดหมู่หรือไม่
    if (empty($category)) {
        $_SESSION['message'] = "กรุณาเลือกหมวดหมู่สินค้า";
        header("Location: {$base_url}/admin/add_product.php");
        exit();
    }

    // สร้าง SQL Query เพื่อเพิ่มข้อมูลสินค้า
    $sql = "INSERT INTO products (name, description, price, category) VALUES ('$name', '$description', '$price', '$category')";

    // ตรวจสอบว่าการเพิ่มข้อมูลสำเร็จหรือไม่
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "สินค้าเพิ่มเรียบร้อยแล้ว!";
        header("Location: {$base_url}/admin/manage_product.php");
        exit();
    } else {
        $_SESSION['message'] = "เกิดข้อผิดพลาดในการเพิ่มสินค้า: " . mysqli_error($conn);
        header("Location: {$base_url}/admin/add_product.php");
        exit();
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
