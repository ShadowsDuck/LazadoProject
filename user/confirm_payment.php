<?php
require("../connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ดึงข้อมูลจากฟอร์มโดยใช้ $_POST
    $user_id = $_POST['user_id'];
    $cartItems = json_decode($_POST['cartItems'], true);
    $customer_address = $_POST['shipping_address'];

    foreach ($cartItems as $item) {
        $sql = "INSERT INTO `orders`
            (`user_id`, `product_id`, `price`, `qty`, `total`, `status`, `customer_name`, `customer_email`, `customer_address`)
        SELECT 
            '$user_id', 
            '{$item['product_id']}', 
            '{$item['price']}', 
            '{$item['qty']}', 
            '{$item['qty']}' * '{$item['price']}', 
            '2', 
            users.fullname, 
            users.email, 
            users.address
        FROM users
        WHERE users.id = '$user_id'";

        $result = mysqli_query($conn, $sql);
        if ($result){
            header("Location:{$base_url}/user/index.php?orderSuccess=1");
        } else {
            header("Location:{$base_url}/user/index.php?orderSuccess=0");
        }
    }
} else {
    die(header("Location:{$base_url}/login/error.php"));
}
