<?php
session_start();
// $open_connect = 1;
require('connect.php');

// if(!isset($_SESSION['id']) || !isset($_SESSION['usertype'])){
//     die(header("location:{$base_url}/login/login.php"));       //ถ้าไม่มี session id || usertype จะถูกส่งไป login.php
// }elseif(isset($_GET['logout'])) {
//     session_destroy();
//     die(header("Location:{$base_url}/login/login.php"));        //ถ้ามีการออกจากระบบ ให้ทำลาย session
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- <h1>hello world</h1>
    <a href="test_page.php?logout=1"></a> -->

    <div class="container my-5">
        <div class="row">
            <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);  

            // Loop ข้อมูลแต่ละแถวในฐานข้อมูล
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-3 mb-1">
                        <div class="card h-100">
                            <img src="https://placehold.co/300" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo $row['price']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No records found.";
            }
            ?>
        </div>
    </div>


</body>

</html>