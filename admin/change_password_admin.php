<?php

session_start();
include('../connect.php');

$id = mysqli_real_escape_string($conn, $_POST['id']);
$current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
$new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

// ดึงแฮชรหัสผ่านที่เก็บไว้จากฐานข้อมูล
$sql = "SELECT password FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $hashed_password = $data['password'];

    // ตรวจสอบว่ารหัสผ่านปัจจุบันถูกต้องหรือไม่
    if (password_verify($current_password, $hashed_password)) {
        // ตรวจสอบว่ารหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ตรงกันหรือไม่
        if ($new_password === $confirm_password) {
            // แฮชรหัสผ่านใหม่
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // อัปเดตข้อมูล admin
            $update_sql = "UPDATE users SET password = '$hashed_new_password' WHERE id = '$id'";
            $query = mysqli_query($conn, $update_sql);

            if ($query) {
                $_SESSION['message'] = "อัปเดตรหัสผ่านสำเร็จแล้ว!";
                header("Location: {$base_url}/admin/manage_admin.php");
            } else {
                $_SESSION['message'] = "อัปเดตรหัสผ่านไม่สำเร็จ!: " . mysqli_error($conn);
                header("Location: {$base_url}/admin/manage_admin.php");
            }
        } else {
            // รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ไม่ตรงกัน
            $_SESSION['message'] = "รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน";
            header("Location: {$base_url}/admin/manage_admin.php");
        }
    } else {
        // รหัสผ่านปัจจุบันไม่ถูกต้อง
        $_SESSION['message'] = "รหัสผ่านปัจจุบันไม่ถูกต้อง";
        header("Location: {$base_url}/admin/manage_admin.php");
    }
} else {
    $_SESSION['message'] = "ไม่พบผู้ดูแล";
    header("Location: {$base_url}/admin/manage_admin.php");
}

mysqli_close($conn);
