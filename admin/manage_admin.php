<?php session_start();
include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <!-- Alert message should be displayed right here -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <h1>Manage Admin</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-2 mb-4 float-end" data-bs-toggle="modal"
        data-bs-target="#addAdminModal">
        Add Admin
    </button>

    <!-- Modal for Add Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_admin.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Fullname field -->
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control" placeholder="Full Name" name="fullname">
                        </div>

                        <!-- Username field -->
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>

                        <!-- Password field -->
                        <div class="form-group mb-3">
                            <label for="admin_password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Password">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleAdminPassword"></i>
                                </span>
                            </div>
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

    <!-- Modal for Update Admin -->
    <div class="modal fade" id="updateAdminModal" tabindex="-1" aria-labelledby="updateAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateAdminForm" action="update_admin.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateAdminModalLabel">Update Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Hidden field to hold admin id -->
                        <input type="hidden" name="id" id="update_admin_id">

                        <!-- Fullname field -->
                        <div class="form-group mb-3">
                            <label for="update_fullname">Fullname</label>
                            <input type="text" class="form-control" id="update_fullname" name="fullname">
                        </div>

                        <!-- Username field -->
                        <div class="form-group mb-3">
                            <label for="update_username">Username</label>
                            <input type="text" class="form-control" id="update_username" name="username">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateAdminBtn" disabled>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Change Password Admin -->
    <div class="modal fade" id="changePasswordAdminModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="changePasswordForm" action="change_password_admin.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Hidden field to hold admin id for change password -->
                        <input type="hidden" name="id" id="change_password_admin_id">

                        <!-- Current Password field -->
                        <div class="form-group mb-3">
                            <label for="current_password">Current Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleCurrentPassword"></i>
                                </span>
                            </div>
                        </div>

                        <!-- New Password field -->
                        <div class="form-group mb-3">
                            <label for="new_password">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleNewPassword"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Confirm New Password field -->
                        <div class="form-group mb-3">
                            <label for="confirm_password">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Error message for password mismatch -->
                        <div id="passwordMismatchError" class="text-danger mb-3" style="display: none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="changePasswordBtn" disabled>Change</button>
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
                            <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#updateAdminModal"
                                data-id="<?php echo $id; ?>"
                                data-fullname="<?php echo $fullname; ?>"
                                data-username="<?php echo $username; ?>">
                                Update
                            </button>
                            <a href="<?php echo "{$base_url}/admin/del_admin.php?id={$id}"; ?>"
                                class="btn btn-danger btn-sm ms-2 me-2 delete_admin"> Delete </a>
                            <button type="button" class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#changePasswordAdminModal"
                                data-id="<?php echo $id; ?>">
                                Change Password
                            </button>

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