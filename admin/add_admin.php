<?php
session_start();
include('../connect.php');

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);

// Check if username already exists
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
$row = mysqli_num_rows($query);

if ($row > 0) {
    // Username is already taken
    $_SESSION['message'] = 'ชื่อผู้ใช้งานนี้ถูกใช้ไปแล้ว กรุณาใช้ชื่ออื่น';
    header("Location: {$base_url}/admin/manage_admin.php");
    exit;
}

if (strlen($_POST['password']) < 6) {
    $_SESSION['message'] = 'รหัสผ่านต้องประกอบด้วยตัวเลขอย่างน้อย 6 หลัก!';
    header("Location: {$base_url}/admin/manage_admin.php");
    exit;
} else {
    if (!empty($username) && !empty($password) && !empty($fullname)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($conn, "INSERT INTO users (username, password, fullname, usertype) 
        VALUES ('{$username}','{$hash}','{$fullname}','admin')") or die("query failed!");

        if ($query) {
            $_SESSION['message'] = 'เพิ่มผู้ดูแลสำเร็จแล้ว!';
            header("Location:{$base_url}/admin/manage_admin.php");
        } else {
            $_SESSION['message'] = 'เพิ่มผู้ดูแลไม่สำเร็จ!';
            header("Location:{$base_url}/admin/manage_admin.php");
        }
    } else {
        $_SESSION['message'] = 'จำเป็นต้องมีข้อมูลครบทุกช่อง';
        header("Location:{$base_url}/admin/manage_admin.php");
    }
}
