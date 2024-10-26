<?php
session_start();
include("../../connect.php");

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่ารหัสผ่านใหม่และยืนยันรหัสผ่านจากฟอร์ม
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // ตรวจสอบว่ารหัสผ่านใหม่และยืนยันรหัสผ่านตรงกัน
    if ($new_password === $confirm_password) {
        // เข้ารหัสรหัสผ่านใหม่
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // อัพเดตรหัสผ่านในฐานข้อมูล
        $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
        if (mysqli_query($conn, $update_sql)) {
            // ย้ายไปที่หน้า passEdit หลังจากบันทึกเสร็จ
            header("Location: {$base_url}/user/user_edit.php?page=passEdit");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "รหัสผ่านใหม่และการยืนยันไม่ตรงกัน";
    }
}
?>
<!-- Include Bootstrap Icons and CSS/JS for modal -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
