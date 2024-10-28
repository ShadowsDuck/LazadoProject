<?php
session_start();
include("../connect.php");

if (isset($_SESSION["id"]) && isset($_SESSION["usertype"])) {
    $user_id = $_SESSION['id'];
    $product_id = $_GET['id'];
    $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1; // รับค่าจำนวนจากฟอร์ม

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

        if ($result) {
            $_SESSION['message'] = "เพิ่มสินค้าสำเร็จ!";
            header("location:{$_SESSION['currentpage']}");
        } else {
            $_SESSION['message'] = "เพิ่มสินค้าไม่สำเร็จ!: " . mysqli_error($conn);
            header("location:{$_SESSION['currentpage']}");
        }
        // เปลี่ยนเส้นทางไปที่หน้า cart.php
        header("location:{$_SESSION['currentpage']}"); // เปลี่ยนเส้นทางไปยัง cart.php
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    die(header("location:{$base_url}/login/login.php"));
}

$conn->close();
