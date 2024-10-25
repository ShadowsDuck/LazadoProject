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
    $_SESSION['message'] = 'Username is already taken! Please use another.';
    header("Location: {$base_url}/login/signup.php");
    exit;
}

if (strlen($_POST['password']) < 6) {
    $_SESSION['message'] = 'Password required 6 digits at least!';
    header("Location: {$base_url}/login/signup.php");
    exit;

} else {
    if (empty($_POST['c-password'])) {
        $_SESSION['message'] = 'Please confirm your password.';
        header("Location: {$base_url}/login/signup.php");
        exit;
    }

    if ($_POST['c-password'] != $_POST['password']) {
        $_SESSION['message'] = 'Password and confirm password did not match.';
        header("Location: {$base_url}/login/signup.php");
        exit;
    }

    if (!empty($username) && !empty($password) && !empty($fullname)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($conn, "INSERT INTO users (username, password, email, fullname, address, usertype) 
        VALUES ('{$username}','{$hash}','{$fullname}','{$email}','{$address}','user')") or die("query failed!");

        if ($query) {
            $_SESSION['message'] = 'Sign-up successful!';
            header("Location:{$base_url}/login/login.php");
        } else {
            $_SESSION['message'] = 'Sign-up failed!';
            header("Location:{$base_url}/login/signup.php");
        }
    } else {
        $_SESSION['message'] = 'Input is required';
        header("Location:{$base_url}/login/signup.php");
    }
}


?>