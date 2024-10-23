<?php
session_start();
include 'config.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

// Check if username already exists
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
$row = mysqli_num_rows($query);

if ($row > 0) {
    // Username is already taken
    $_SESSION['message'] = 'Username is already taken! Please choose another.';
    header("Location: {$base_url}/register.php");
    exit;
}

if (!empty($username) && !empty($password) && !empty($fullname)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = mysqli_query($conn, "INSERT INTO users (username, password, fullname, address, usertype) 
    VALUES ('{$username}','{$hash}','{$fullname}','{$address}','user')") or die("query failed!");

    if ($query) {
        $_SESSION['message'] = 'Register successful!';
        header("Location:{$base_url}/login.php");
    } else {
        $_SESSION['message'] = 'Register failed!';
        header("Location:{$base_url}/register.php");
    }
} else {
    $_SESSION['message'] = 'Input is required';
    header("Location:{$base_url}/register.php");
}
