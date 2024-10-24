<?php
session_start();
include('../connect.php');

$userID = $_GET['id'];
$sql = 'DELETE FROM users WHERE id = "' . $userID . '"';

$query = mysqli_query($conn, $sql);

if ($query) {
    $_SESSION['message'] = 'Delete admin successful!';
    header("Location:{$base_url}/admin/manage_admin.php");
}
