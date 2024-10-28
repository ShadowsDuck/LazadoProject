<?php
session_start();
include '../connect.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Check if username already exists
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
$row = mysqli_num_rows($query);

if ($row > 0) {
    // Username is already taken
    $_SESSION['message'] = 'ชื่อผู้ใช้งานนี้ถูกใช้งานแล้ว!';
    $_SESSION['success'] = false;
    header("Location: {$base_url}/login/signup.php");
    exit;
}

// Check password length
if (strlen($_POST['password']) < 6) {
    $_SESSION['message'] = 'ต้องการรหัสผ่านขั้นต่ำ 6 หลัก!';
    $_SESSION['success'] = false;
    header("Location: {$base_url}/login/signup.php");
    exit;
}

// Check if password confirmation is empty
if (empty($_POST['c-password'])) {
    $_SESSION['message'] = 'โปรดยืนยันรหัสผ่าน!';
    $_SESSION['success'] = false;
    header("Location: {$base_url}/login/signup.php");
    exit;
}

// Check if password and confirmation match
if ($_POST['c-password'] != $_POST['password']) {
    $_SESSION['message'] = 'รหัสผ่าน และรหัสผ่านยืนยันไม่ตรงกัน!';
    $_SESSION['success'] = false;
    header("Location: {$base_url}/login/signup.php");
    exit;
}

// If all fields are filled out correctly, proceed with registration
if (!empty($username) && !empty($password) && !empty($fullname)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = mysqli_query($conn, "INSERT INTO users (username, password, email, fullname, address, usertype) 
        VALUES ('{$username}', '{$hash}', '{$email}', '{$fullname}', '{$address}', 'user')");

    if ($query) {
        $_SESSION['message'] = 'ลงทะเบียนสำเร็จ!';
        $_SESSION['success'] = true;
        header("Location: {$base_url}/login/login.php");
    } else {
        $_SESSION['message'] = 'ลงทะเบียนล้มเหลว!';
        $_SESSION['success'] = false;
        header("Location: {$base_url}/login/signup.php");
    }
} else {
    $_SESSION['message'] = 'โปรดกรอกฟอร์ม!';
    $_SESSION['success'] = false;
    header("Location: {$base_url}/login/signup.php");
}
