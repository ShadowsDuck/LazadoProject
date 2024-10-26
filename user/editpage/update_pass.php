<?php
session_start();
include("../../connect.php");

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id=$user_id";

        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['update_status'] = 'success';
        } else {
            $_SESSION['update_status'] = 'error';
        }
    } else {
        $_SESSION['update_status'] = 'mismatch';
    }
    header("Location: {$base_url}/user/user_edit.php?page=infoEdit");
    exit;
}
?>
