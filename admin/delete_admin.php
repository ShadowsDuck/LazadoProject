<?php
include('../config.php');

echo $id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=" . $id;
