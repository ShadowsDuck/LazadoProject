<?php
session_start();
include '../connect.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (strlen($password) < 6) {
    $_SESSION['message'] = "ต้องการรหัสผ่านขั้นต่ำ 6 หลัก!";
    header("location:{$base_url}/login/login.php");
} else {
    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($result);

        if ($row == 1) {
            $user = mysqli_fetch_assoc($result);

            // เช็คว่า รหัสผ่านที่ป้อนเข้ามาตรงกับฐานข้อมูลหรือไม่ 
            if (password_verify($password, $user['password'])) {
                // เก็บ session login
                // $_SESSION[WP . 'checklogin'] = true;
                // $_SESSION[WP . 'id'] = $user['id'];
                // $_SESSION[WP . 'fullname'] = $user['fullname'];

                // ตรวจสอบบทบาทของผู้ใช้จาก username
                if ($user['usertype'] == 'admin') {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['usertype'] = $user['usertype'];
                    header("location:{$base_url}/admin/index_admin.php");

                } elseif ($user['usertype'] == 'user') {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['usertype'] = $user['usertype'];
                    header("location:{$base_url}/user/index.php");

                } else {
                    header("location:{$base_url}/user/index.php");
                }

            } else {
                $_SESSION['message'] = "ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง!";
                header("location:{$base_url}/login/login.php");
            }
        } else {
            $_SESSION['message'] = "ไม่พบชื่อผู้ใช้งานนี้!";
            header("location:{$base_url}/login/login.php");
        }
    } else {
        $_SESSION['message'] = "โปรดกรอกชื่อผู้ใช้งาน และรหัสผ่าน!";
        header("location:{$base_url}/login/login.php");
    }
}


