<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <?php if (!empty($_SESSION['message'])): ?>
            <?php
            $alert_class = 'alert-warning';
            if (strpos($_SESSION['message'], 'successful') !== false) {
                $alert_class = 'alert-success';
            }
            ?>
            <div class="alert <?php echo $alert_class; ?> alert-dismissible fade show my-5" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="row d-flex align-items-center justify-content-center" style="height: 550px;">
            <div class="col-sm-5">
                <h1>Login</h1>
                <form action="<?php echo "{$base_url}/login-form.php"; ?>" method="post" class="border rounded p-5">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo "{$base_url}/register.php"; ?>" class="btn btn-warning">Go to Register</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>