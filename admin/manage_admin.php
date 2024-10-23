<?php session_start();
include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <div class="alert-container">
        <?php if (!empty($_SESSION['message'])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    </div>

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
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../config.php');
            $sql = "SELECT * FROM users WHERE usertype='admin'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            $sn = 1;

            if ($row > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $id = $data['id'];
                    $fullname = $data['fullname'];
                    $username = $data['username'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <!-- <a href="#" class="btn btn-info btn-sm view_admin"> View </a> -->
                            <a href="#" class="btn btn-success btn-sm ms-2 update_admin"> Update </a>
                            <a href="<?php echo "{$base_url}/admin/del_admin.php?id={$id}"; ?>"
                                class="btn btn-danger btn-sm ms-2 delete_admin"> Delete </a>
                        </td>
                    </tr>
                    <?php

                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="text-center" style="vertical-align: middle;">ไม่พบข้อมูลผู้ดูแล</td>
                </tr>
                <?php
            }

            ?>

        </tbody>
    </table>
</div>

<?php include('partials/footer.php'); ?>

<!-- <script>
    $(document).ready(function() {

        $('.view_admin').click(function(e) {
            e.preventDefault();

            $(this).closest('tr').
        });
    });
</script> -->