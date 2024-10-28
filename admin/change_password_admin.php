<?php
session_start();
include('../connect.php');

// ตั้งค่า success เริ่มต้นเป็น true
$_SESSION['success'] = true;

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
            // ตรวจสอบความยาวรหัสผ่านใหม่อย่างน้อย 6 ตัว
            if (strlen($new_password) < 6) {
                $_SESSION['message'] = "รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 6 ตัวอักษร!";
                $_SESSION['success'] = false;
                header("Location: {$base_url}/admin/manage_admin.php");
                exit;
            }

            // แฮชรหัสผ่านใหม่
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // อัปเดตข้อมูล admin
            $update_sql = "UPDATE users SET password = '$hashed_new_password' WHERE id = '$id'";
            $query = mysqli_query($conn, $update_sql);

            if ($query) {
                $_SESSION['message'] = "อัปเดตรหัสผ่านสำเร็จแล้ว!";
                $_SESSION['success'] = true;
            } else {
                $_SESSION['message'] = "อัปเดตรหัสผ่านไม่สำเร็จ! เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
                $_SESSION['success'] = false;
            }
        } else {
            $_SESSION['message'] = "รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน";
            $_SESSION['success'] = false;
        }
    } else {
        $_SESSION['message'] = "รหัสผ่านปัจจุบันไม่ถูกต้อง";
        $_SESSION['success'] = false;
    }
} else {
    $_SESSION['message'] = "ไม่พบผู้ดูแล";
    $_SESSION['success'] = false;
}

header("Location: {$base_url}/admin/manage_admin.php");
mysqli_close($conn);
