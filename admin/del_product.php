<?php
session_start();
include('../connect.php');

$productID = $_GET['id'];
$sql = 'DELETE FROM products WHERE id = "' . $productID . '"';

$query = mysqli_query($conn, $sql);

var_dump($base_url);

if (!isset($_GET['id'])) {
    $_SESSION['message'] = 'ID ของสินค้าไม่ถูกต้อง';
    // header("Location:{$base_url}/admin/manage_product.php");
    // exit();
}

if ($query) {
    $_SESSION['message'] = 'ลบสินค้าสำเร็จแล้ว!';
    header("Location:{$base_url}/admin/manage_product.php");
}
