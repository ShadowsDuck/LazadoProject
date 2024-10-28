<?php
session_start();
include("../../connect.php");

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // ดึงรหัสผ่านปัจจุบันจากฐานข้อมูล
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // ตรวจสอบรหัสผ่านเดิม
    if (!password_verify($current_password, $user['password'])) {
        $_SESSION['update_status'] = 'error';
        header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
        exit();
    }

    // ตรวจสอบความยาวรหัสผ่านใหม่
    if (strlen($new_password) < 6) {
        $_SESSION['update_status'] = 'short_password';
        header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
        exit();
    }

    // ตรวจสอบรหัสผ่านใหม่และยืนยันรหัสผ่านใหม่
    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // อัปเดตรหัสผ่านใหม่ในฐานข้อมูล
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

    header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
    exit;
}
