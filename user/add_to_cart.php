<?php
session_start();
include("../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'] ?? 'Anonymous';  // กำหนด user_id เป็น 'Anonymous' หากไม่ได้ล็อกอิน
    $product_id = $_POST['selected_products'][0];  // รับค่า product_id ที่ส่งมาจากฟอร์ม
    $qty = $_POST['quantity'];  // รับค่าจำนวนจากฟอร์ม

    // ตรวจสอบว่ามีสินค้าในตะกร้าอยู่แล้วหรือไม่ในฐานข้อมูล
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // ถ้ามีอยู่แล้ว ให้อัปเดตจำนวนสินค้า
        $sql = "UPDATE cart SET qty = qty + $qty WHERE user_id = '$user_id' AND product_id = '$product_id'";
    } else {
        // ถ้าไม่มีให้เพิ่มสินค้าใหม่
        $sql = "INSERT INTO cart (user_id, product_id, qty) VALUES ('$user_id', '$product_id', '$qty')";
    }

    // ดำเนินการกับฐานข้อมูล
    if (mysqli_query($conn, $sql)) {
        // เก็บข้อมูลสินค้าในเซสชันด้วย
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        // เพิ่มจำนวนสินค้าลงในเซสชัน
        $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + $qty;

        // เปลี่ยนเส้นทางไปที่หน้า cart.php
        header("Location: kart.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}

$conn->close();
?>
