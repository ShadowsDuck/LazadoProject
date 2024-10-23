<?php
session_start();
include("../config.php");

$userID = $_GET['id'];
$sql = 'DELETE FROM users WHERE id = "' . $userID . '"';

$query = mysqli_query($conn, $sql);

if ($query) {
    $_SESSION['message'] = 'Sign-up successful!';
    header("Location:{$base_url}/admin/manage_admin.php");
}
