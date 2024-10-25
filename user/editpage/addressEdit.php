<?php
session_start();
require("../../connect.php");
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql) or die('connection failed');
$row = $result->fetch_assoc();
?>

<div class="container ms-1" style="border-radius: 5px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>ที่อยู่สำหรับจัดส่ง</h4>
        <button class="btn btn-edit">แก้ไขที่อยู่</button>
    </div>

    <div class="user-info d-flex align-items-center">
        <div>
            <h5><?php echo $row['address']; ?></h5>
            <p><?php echo $row['email']; ?></p>
        </div>
    </div>

    
</div>