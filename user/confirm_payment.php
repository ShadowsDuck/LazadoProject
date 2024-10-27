<?php
require("../connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ดึงข้อมูลจากฟอร์มโดยใช้ $_POST
    $user_id = $_POST['user_id'];
    $cartItems = json_decode($_POST['cartItems'], true);
    $customer_address = $_POST['shipping_address'];
    $total_amount = $_POST['total_amount'];
    $discount = $_POST['discount'];
    $price = 0;

    foreach ($cartItems as $item) {
        if ($discount == 1) {
            $price = $item['discounted_price'];
        } else {
            $price = $item['price'];
        }

        $sql = "INSERT INTO `orders`
            (`user_id`, `product_id`, `price`, `qty`, `total`,`order_date`, `status`, `customer_name`, `customer_email`, `customer_address`)
        SELECT 
            '$user_id', 
            '{$item['product_id']}', 
            '{$price}', 
            '{$item['qty']}', 
            '{$item['qty']}' * '{$price}', 
            NOW(),
            '1', 
            users.fullname, 
            users.email, 
            users.address
        FROM users
        WHERE users.id = '$user_id'";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql = "DELETE FROM cart WHERE id = '{$item['id']}'";
            $result = mysqli_query($conn, $sql);
            $_SESSION['orderSuccess'] = '1';
            header("Location:{$base_url}/user/index.php?orderSuccess=1");
        } else {
            $_SESSION['orderSuccess'] = '0';
            header("Location:{$base_url}/user/index.php?orderSuccess=0");
        }
    }
} else {
    die(header("Location:{$base_url}/login/error.php"));
}
