<?php
session_start();
header('Content-Type: application/json');
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']); // ล้าง session หลังจากส่งค่า
echo json_encode(['message' => $message]);
