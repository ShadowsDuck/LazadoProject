<?php
session_start();
include('../connect.php');

// รับข้อมูลจากฟอร์ม
$id = mysqli_real_escape_string($conn, $_POST['id']);
$current_password = mysqli_real_escape_string($conn, $_POST['password']); // รหัสผ่านปัจจุบัน
$new_password = mysqli_real_escape_string($conn, $_POST['new_password']); // รหัสผ่านใหม่
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']); // ยืนยันรหัสผ่านใหม่

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
                $_SESSION['message'] = "Record updated successfully.";
                header("Location: {$base_url}/admin/manage_admin.php");
            } else {
                $_SESSION['message'] = "Error updating record: " . mysqli_error($conn);
                header("Location: {$base_url}/admin/manage_admin.php");
            }
        } else {
            // รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ไม่ตรงกัน
            $_SESSION['message'] = "New password and confirm password do not match.";
            header("Location: {$base_url}/admin/manage_admin.php");
        }
    } else {
        // รหัสผ่านปัจจุบันไม่ถูกต้อง
        $_SESSION['message'] = "Current password is incorrect.";
        header("Location: {$base_url}/admin/manage_admin.php");
    }
} else {
    $_SESSION['message'] = "Admin not found.";
    header("Location: {$base_url}/admin/manage_admin.php");
}

mysqli_close($conn);
