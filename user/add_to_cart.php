<?php
session_start();
include("../connect.php");

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $user_id = $_SESSION['id'];

    // ตรวจสอบว่ามีสินค้านี้ในตะกร้าของผู้ใช้แล้วหรือไม่
    $check_cart_query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $check_result = $conn->query($check_cart_query);

    if ($check_result->num_rows > 0) {
        // ถ้ามีสินค้าอยู่แล้ว ให้เพิ่มจำนวน
        $update_query = "UPDATE cart SET qty = qty + $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $conn->query($update_query);
    } else {
        // ถ้ายังไม่มี ให้เพิ่มสินค้าลงในตะกร้า
        $insert_query = "INSERT INTO cart (user_id, product_id, qty) VALUES ('$user_id', '$product_id', $quantity)";
        $conn->query($insert_query);
    }

    // เปลี่ยนเส้นทางไปยังหน้าตะกร้า
    header("Location: cart.php");
    exit;
} else {
    // หากไม่มีข้อมูลที่ถูกต้อง ให้เปลี่ยนเส้นทางไปยังหน้าหลัก
    header("Location: index.php");
    exit;
}
?>

