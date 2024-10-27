<?php
require("../connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ดึงข้อมูลจากฟอร์มโดยใช้ $_POST
    $user_id = $_POST['user_id'];
    $qty = $_POST['total_amount'];
    $customer_address = $_POST['shipping_address'];

    $sql = "INSERT INTO 'orders'
            ('user_id', 'product_id', 'price', 'qty', 'total', 'order_date', 'status', 'customer_name', 'customer_email', 'customer_address')
            VALUES ($user_id, '2', '3890', '2', '6000', '2024-10-27 19:04:06.000000', '0', 'asdasd', 'asdasd', 'asdasd');";
} else {
    die(header("Location:{$base_url}/login/error.php"));
}
?>