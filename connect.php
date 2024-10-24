<?php

// if ($open_connect != 1) {
//     die(header("Loacation: /login/login.php"));
// }

// var url
$base_url = 'http://localhost/LazadoProject';

// var database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'lazado';

// connect database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('connection failed');

// prefix session
// define('WP', 'mylogin2024');