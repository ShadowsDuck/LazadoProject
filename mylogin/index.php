<?php
session_start();
include 'config.php';

if (empty($_SESSION[WP . 'checklogin'])) {
    $_SESSION['message'] = "You are not logged in.";
    header("Location:{$base_url}/login.php");
    exit;
}

// ดึงข้อมูลมาแสดงผล
$user_id = $_SESSION[WP . 'id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='{$user_id}'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 550px;">
            <div class="col-sm-5">
                <h1 class="mb-4">My Profile</h1>
                <table class="table table-striped">
                    <tr>
                        <td style="width: 200px;">Username</td>
                        <td><?php echo $user['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Fullname</td>
                        <td><?php echo $user['fullname']; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $user['address']; ?></td>
                    </tr>
                </table>

                <a href="<?php echo "{$base_url}/logout.php"; ?>" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>