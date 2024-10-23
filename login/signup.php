<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .alert-container {
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 9999;
            /* ให้มันอยู่ด้านบนสุด */
        }
    </style>
</head>
<body>

    <div class="container min-vh-100 min-vw-100 d-flex justify-content-center align-items-center">

        <div class="alert-container">
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>

        <div class="row w-100">
            <!-- Left side: Image -->
            <div class="col-md-7 d-none d-md-flex align-items-center">
                <img src="https://img.freepik.com/premium-photo/top-view-gaming-gear_160097-847.jpg" alt="Sign Up Image"
                    class="img-fluid rounded-end w-100">
            </div>

            <!-- Form -->
            <div class="col-md-5 d-md-flex align-items-center justify-content-center">
                <div class="container p-4 mx-auto" style="width: 60%; max-width: 60%; min-width: 350px;">
                    <h2 class="text-center mb-3">Create an account</h2>
                    <form action="signup_db.php" method="POST">
                        <div class="mb-2">
                            <label for="fname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fname" name="fullname" placeholder="Full Name" required>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Username" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="c-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="c-password" name="c-password"
                                placeholder="Confirm Password" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mb-0">Already have an account? <a href="login.php" class="text-danger">Log-in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>