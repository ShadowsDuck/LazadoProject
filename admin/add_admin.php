<?php
session_start();
include('../config.php');

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);

// Check if username already exists
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
$row = mysqli_num_rows($query);

if ($row > 0) {
    // Username is already taken
    $_SESSION['message'] = 'Username is already taken! Please use another.';
    header("Location: {$base_url}/admin/manage_admin.php");
    exit;
}

if (strlen($_POST['password']) < 6) {
    $_SESSION['message'] = 'Password required 6 digits at least!';
    header("Location: {$base_url}/admin/manage_admin.php");
    exit;
} else {

    if (!empty($username) && !empty($password) && !empty($fullname)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($conn, "INSERT INTO users (username, password, fullname, usertype) 
        VALUES ('{$username}','{$hash}','{$fullname}','admin')") or die("query failed!");

        if ($query) {
            $_SESSION['message'] = 'Add admin successful!';
            header("Location:{$base_url}/admin/manage_admin.php");
        } else {
            $_SESSION['message'] = 'Add admin failed!';
            header("Location:{$base_url}/admin/manage_admin.php");
        }
    } else {
        $_SESSION['message'] = 'Input is required';
        header("Location:{$base_url}/admin/manage_admin.php");
    }
}
