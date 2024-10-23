<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 min-vw-100">
        <div class="row w-100">
            <!-- Left side: Image -->
            <div class="col-md-7 d-none d-md-flex align-items-center">
                <img src="https://img.freepik.com/premium-photo/red-black-gaming-accessories-flat-lay_1346134-20564.jpg" alt="Sign Up Image"
                    class="img-fluid rounded-end w-100">
            </div>
            <div class="col-md-5 d-md-flex align-items-center justify-content-center">
                <div class="container p-4" style="width: 60%; max-width: 60%; min-width: 350px;">
                    <h2 class="text-center mb-3">Log-in</h2>
                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" placeholder="Userame">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-danger">Log-in</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mb-0">Did not have an account? <a href="signup.php" class="text-primary">Create Account</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>