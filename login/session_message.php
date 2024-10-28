<?php
session_start();
$response = [];

if (!empty($_SESSION['message'])) {
    $response['message'] = $_SESSION['message'];
    // ตรวจสอบสถานะการลงทะเบียนและกำหนด icon
    $response['icon'] = isset($_SESSION['success']) && $_SESSION['success'] ? 'success' : 'warning';

    unset($_SESSION['message']);
    unset($_SESSION['success']);
}

echo json_encode($response);
