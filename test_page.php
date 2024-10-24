<?php
session_start();
$open_connect = 1;
require('connect.php');

if(!isset($_SESSION['id']) || !isset($_SESSION['usertype'])){
    die(header("location:{$base_url}/login/login.php"));       //ถ้าไม่มี session id || usertype จะถูกส่งไป login.php
}elseif(isset($_GET['logout'])) {
    session_destroy();
    die(header("Location:{$base_url}/login/login.php"));        //ถ้ามีการออกจากระบบ ให้ทำลาย session
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello world</h1>
    <a href="test_page.php?logout=1"></a>
</body>
</html>