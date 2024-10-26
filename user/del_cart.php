<?php
session_start();
include("../connect.php");

if (isset($_GET["id"])) {
    $cart_id = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id = '$cart_id'";
    $result = mysqli_query($conn, $sql);
    header("Location:{$base_url}/user/kart.php");
}else{
    die(header("Location:{$base_url}/login/error.php"));
}
?>