
<?php
// session_start();
// $open_connect = 1;
// require('../connect.php');

// if (!isset($_SESSION['id']) || !isset($_SESSION['usertype'])) {
//     die(header("location:{$base_url}/login/login.php"));       //ถ้าไม่มี session id || usertype จะถูกส่งไป login.php
// } elseif (isset($_GET['logout'])) {
//     session_destroy();
//     die(header("Location:{$base_url}/login/login.php"));        //ถ้ามีการออกจากระบบ ให้ทำลาย session
// }
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

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .navbar-nav {
            margin: auto;

        }

        .input-group-text {
            cursor: pointer;
        }

        .category-menu {
            padding-top: 0px;
        }

        .category-menu a {
            display: block;
            margin-bottom: 15px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .carousel-item img {
            width: 100%;
            height: 340px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            filter: invert(100%);
            /* ทำให้ลูกศรสีขาวมองเห็นได้ดีขึ้น */
        }

        .container-fluid {
            padding-left: 30px;
            /* เพิ่ม padding-left */
            padding-right: 30px;
            /* เพิ่ม padding-right */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container mt-4">
            <a class="navbar-brand fw-bold fs-3" href="index.php">Lazado Gaming</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link active" href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="contact.php">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="../login/signup.php">สมัครสมาชิก</a>
                    </li>
                </ul>
                <div class="d-flex">

                    <div class="input-group">
                        <input type="text" aria-label="Search" class="form-control" placeholder="ค้นหาสินค้า">
                        <div class="input-group-text search-icon-class">
                            <i class="bi bi-search"></i> <!-- หรือไอคอนค้นหาอื่น ๆ -->
                        </div>
                    </div>

                    <a href="kart.php" class="ms-4 mt-1"><i style="color:black;" class="bi bi-cart3 h4"></i></a>

                </div>
            </div>
        </div>
    </nav>
</body>

</html>