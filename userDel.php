<html>

<head>

<title>Delete Customer </title>

</head>

<body>

<?php

	ini_set('display_errors', 1);

	error_reporting(~0);

	$serverName = "localhost";

	$userName = "root";

	$userPassword = "";

	$dbName = "lazado";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$CusID = $_GET["CusID"];

	$sql = "DELETE FROM users  WHERE id = '".$CusID."' ";

	$query = mysqli_query($conn,$sql);



	if(mysqli_affected_rows($conn)) {

		 echo "Record delete successfully";

	}

	mysqli_close($conn);

?>

</body>

</html>