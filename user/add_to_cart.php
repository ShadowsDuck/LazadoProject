<?php
session_start();
include("../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'] ?? 'Anonymous';
    $product_id = $_POST['selected_products'][0];  // รับค่า product_id ที่ส่งมาจากฟอร์ม
    $qty = $_POST['quantity'];

    // ตรวจสอบว่ามีสินค้าในตะกร้าอยู่แล้วหรือไม่ ถ้ามีให้เพิ่มจำนวน
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE cart SET qty = qty + $qty WHERE user_id = '$user_id' AND product_id = '$product_id'";
    } else {
        $sql = "INSERT INTO cart (user_id, product_id, qty) VALUES ('$user_id', '$product_id', '$qty')";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: kart.php");  // ส่งไปที่หน้าตะกร้า
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}

$conn->close();
?>
