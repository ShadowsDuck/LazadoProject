<?php include('partials/header.php'); ?>

<div class="container mt-5">
    <h1> Add Admin </h1>

    <form action="" method="POST">
        <table class=" table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>admin</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="text" name="username" placeholder="Username"></td>
                <td><input type="text" name="fullname" placeholder="Fullname"></td>
                <td><input type="email" name="email" placeholder="Email"></td>
            </tr>
        </table>
    </form>
</div>

<?php include('partials/footer.php'); ?>