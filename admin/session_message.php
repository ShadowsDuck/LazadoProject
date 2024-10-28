<?php
session_start();
$response = [];

if (!empty($_SESSION['message'])) {
    $response['message'] = $_SESSION['message'];
    // ตรวจสอบสถานะการดำเนินการและกำหนดไอคอน
    $response['icon'] = isset($_SESSION['success']) && $_SESSION['success'] ? 'success' : 'error';

    // ลบข้อความและสถานะที่ใช้แล้วออกจากเซสชัน
    unset($_SESSION['message']);
    unset($_SESSION['success']);
}

echo json_encode($response);
