<?php
session_start();
$open_connect = 1;
require('../../connect.php');

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
    <title>Bootstrap E-Commerce Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .alert-container {
            position: absolute;
            top: 0;
            /* width: 30%; */
            margin: auto;
            z-index: 9999;
            /* ให้มันอยู่ด้านบนสุด */
        }
    </style>
</head>

<body>
    <?php $currentPage = basename($_SERVER['REQUEST_URI']); ?>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container justify-content-center">
            <ul class="nav nav-pills mx-auto mb-2 mb-lg-0">
                <li class="nav-item ms-5 me-4 fs-6">
                    <a class="nav-link <?php echo ($currentPage === "index_admin.php") ? 'active' : ''; ?>" href="index_admin.php" aria-current="page">หน้าแรก</a>
                </li>
                <li class="nav-item me-4 fs-6">
                    <a class="nav-link <?php echo ($currentPage === 'manage_admin.php') ? 'active' : ''; ?>" href="manage_admin.php" aria-current="page">ผู้ดูแล</a>
                </li>
                <li class="nav-item me-4 fs-6">
                    <a class="nav-link <?php echo ($currentPage === 'manage_item.php') ? 'active' : ''; ?>" href="manage_item.php" aria-current="page">จัดการสินค้า</a>
                </li>
                <li class="nav-item me-4 fs-6">
                    <a class="nav-link <?php echo ($currentPage === 'manage_order.php') ? 'active' : ''; ?>" href="manage_order.php" aria-current="page">รายการคำสั่งซื้อ</a>
                </li>
            </ul>
            <a href="../index_admin.php"><button type="button" class="btn btn-danger">ออกจากระบบ</button></a>
        </div>
    </nav>
</body>


</html>