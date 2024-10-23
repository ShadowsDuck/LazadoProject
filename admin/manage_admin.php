<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <h1>Manage Admin</h1>

    <!-- Button to Add Admin -->
    <!-- <a href="add_admin.php" class="btn btn-primary mt-2 mb-4"> Add Admin </a> -->

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-2 mb-4 float-end" data-bs-toggle="modal"
        data-bs-target="#addAdminModal">
        Add Admin
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_admin.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Fullname</label>
                            <input type="text" class="form-control" placeholder="Enter Fullname" name="fullname">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Username</label>
                            <input type="text" class="form-control" placeholder="Enter Username" name="username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="text" class="form-control" placeholder="Enter Password" name="password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <table class=" table table-striped table-hover">
        <tr>
            <th>S.N.</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>

        <tr>
            <td>1. </td>
            <td>Tanaphat Partoom</td>
            <td>ShadowsDuck</td>
            <td>
                <a href="#" class="btn btn-success btn-sm"> Update Admin </a>
                <a href="#" class="btn btn-danger btn-sm ms-1"> Delete Admin </a>
            </td>
        </tr>
    </table>
</div>

<?php include('partials/footer.php'); ?>