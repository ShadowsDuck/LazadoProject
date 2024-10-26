<?php
session_start();
include("../../connect.php");

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // ตรวจสอบความยาวรหัสผ่าน
    if (strlen($new_password) < 6) {
        $_SESSION['update_status'] = 'short_password';
        header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
        
        exit();
    }
    
    // ตรวจสอบรหัสผ่านที่ยืนยัน
    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
        $update_sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $hashed_password, $user_id);

        if ($stmt->execute()) {
            $_SESSION['update_status'] = 'success';
        } else {
            $_SESSION['update_status'] = 'error';
        }
        $stmt->close();
    } else {
        $_SESSION['update_status'] = 'mismatch';
    }

    // ส่งกลับไปยัง passEdit.php
    header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
    exit;
}
?>
