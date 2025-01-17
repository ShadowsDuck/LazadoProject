<?php
session_start();
$open_connect = 1;
require('../connect.php');

if (isset($_SESSION['id']) and isset($_SESSION['usertype'])) {
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
}

if (isset($_GET['logout'])) {
    session_destroy();
    die(header("Location:{$base_url}/login/login.php"));        //ถ้ามีการออกจากระบบ ให้ทำลาย session
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAZADO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="icon" href="partials/LAZADO.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"
                            href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>"
                            href="contact.php">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>"
                            href="about.php?page=aboutSidebar" data-page="aboutpage/aboutSidebar.php">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link <?php echo ($current_page == 'user_edit.php') ? 'active' : ''; ?>"
                            href="<?php if (isset($_SESSION['id']) && isset($_SESSION['usertype'])) {
                                        echo 'user_edit.php?page=infoEdit';
                                    } else {
                                        echo '../login/login.php'; // ถ้าไม่ได้เข้าสู่ระบบให้ไปหน้า login.php
                                    }
                                    ?>">
                            <?php
                            if (isset($_SESSION['id']) && isset($_SESSION['usertype'])) {
                                echo 'จัดการบัญชีของคุณ';
                            } else {
                                echo 'เข้าสู่ระบบ';
                            }
                            ?>
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <form action="allitem.php" method="get" class="input-group">
                        <input type="text" aria-label="Search" class="form-control" placeholder="ค้นหาสินค้า"
                            id="keyword" name="keyword">
                        <button type="submit" class="input-group-text search-icon-class">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <!-- Container สำหรับไอคอนตะกร้าและไอคอนจุดสีแดง -->
                    <div class="position-relative ms-4 mt-1">
                        <a href=cart.php><i style="color:black;" class="bi bi-cart3 h4"></i></a>

                        <?php if (isset($_SESSION['id']) and isset($_SESSION['usertype'])) {
                            if ($numrows > 0) { ?>
                                <div class="spinner-grow spinner-grow-sm text-danger"
                                    role="status"
                                    style="font-size:20px; position: absolute; margin-right: 10px; width:0.5rem; height:0.5rem; animation-duration: 1.5s;">
                                </div>
                                <!-- <i class="bi bi-dot" style="color:red; font-size:20px; position: absolute;"></i> -->
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>



</body>

</html>