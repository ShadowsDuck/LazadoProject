<?php
session_start();
include("../connect.php");
if (isset($_SESSION["id"]) and isset($_SESSION["usertype"])) {
    $id = $_SESSION["id"];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_SESSION['id'];
        $product_id = $_GET['id'];
        $qty = $_POST['quantity'];
    
        $sql = "INSERT INTO cart (user_id, product_id, qty) VALUES ('{$user_id}', '{$product_id}', '{$qty}')";
        mysqli_query($conn, $sql);
        header("location:{$base_url}/user/item_details.php?id={$product_id}");
    }
}else{
    die(header("location:{$base_url}/login/login.php"));
}
$conn->close();
?>