<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <!-- Alert message should be displayed right here -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show alert-overlay" id="session-alert" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <h1>จัดการผู้ดูแล</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-2 mb-4 float-end" data-bs-toggle="modal" data-bs-target="#addAdminModal">เพิ่มผู้ดูแล</button>

    <!-- Modal for Add Admin -->
    <div class="modal fade" id="addAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_admin.php" method="post" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">เพิ่มผู้ดูแล</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Fullname field -->
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="fullname">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control is-invalid" placeholder="กรุณาใส่ชื่อ-นามสกุล" name="fullname" required>
                            <div class="invalid-feedback">
                                กรุณาใส่ชื่อ-นามสกุล
                            </div>
                        </div>

                        <!-- Username field -->
                        <div class="form-group mb-3">
                            <label for="username">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control is-invalid" placeholder="กรุณาใส่ชื่อผู้ใช้" name="username" required>
                            <div class="invalid-feedback">
                                กรุณาใส่ชื่อผู้ใช้
                            </div>
                        </div>

                        <!-- Password field -->
                        <div class="form-group mb-3">
                            <label for="admin_password">รหัสผ่าน</label>
                            <div class="input-group">
                                <input type="password" class="form-control is-invalid" id="admin_password" name="password" placeholder="กรุณาใส่รหัสผ่าน" required>
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleAdminPassword"></i>
                                </span>
                                <div class="invalid-feedback">
                                    กรุณาใส่รหัสผ่านที่มีความยาวอย่างน้อย 6 ตัว
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary" disabled>เพิ่มผู้ดูแล</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for Update Admin -->
    <div class="modal fade" id="updateAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateAdminForm" action="update_admin.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateAdminModalLabel">อัปเดตข้อมูลผู้ดูแล</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Hidden field to hold admin id -->
                        <input type="hidden" name="id" id="update_admin_id">

                        <!-- Fullname field -->
                        <div class="form-group mb-3">
                            <label for="update_fullname">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" id="update_fullname" name="fullname">
                        </div>

                        <!-- Username field -->
                        <div class="form-group mb-3">
                            <label for="update_username">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" id="update_username" name="username">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary" id="updateAdminBtn" disabled>อัปเดต</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Change Password Admin -->
    <div class="modal fade" id="changePasswordAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="changePasswordForm" action="change_password_admin.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">เปลี่ยนรหัสผ่าน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Hidden field to hold admin id for change password -->
                        <input type="hidden" name="id" id="change_password_admin_id">

                        <!-- Current Password field -->
                        <div class="form-group mb-3">
                            <label for="current_password">รหัสผ่าน</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="กรุณาใส่รหัสผ่าน">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleCurrentPassword"></i>
                                </span>
                            </div>
                        </div>

                        <!-- New Password field -->
                        <div class="form-group mb-3">
                            <label for="new_password">รหัสผ่านใหม่</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="กรุณาใส่รหัสผ่านใหม่">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleNewPassword"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Confirm New Password field -->
                        <div class="form-group mb-3">
                            <label for="confirm_password">ยืนยันรหัสผ่านใหม่</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="กรุณาใส่รหัสผ่านใหม่อีกครั้ง">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Error message for password mismatch -->
                        <div id="passwordMismatchError" class="text-danger mb-3" style="display: none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary" id="changePasswordBtn" disabled>เปลี่ยนรหัสผ่าน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Confirm Delete -->
    <div class="container-delete">
        <div class="modal fade" id="confirmDelete" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icons">
                            <i class="icon">&times;</i>
                        </div>
                        <h4 class="modal-title">คุณแน่ใจใช่ไหม?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณแน่ใจใช่ไหมที่จะลบผู้ดูแลคนนี้? <br>หลังจากลบไปแล้วคุณไม่สามารถกู้คืนข้อมูลได้</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <a href="#" class="btn btn-danger" id="confirmDeleteBtn">ลบ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style="width: 50px;">ลำดับ</th>
                <th style="width: 200px;">ชื่อ-นามสกุล</th>
                <th style="width: 200px;">ชื่อผู้ใช้</th>
                <th style="width: 200px;">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../connect.php');
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
                                อัปเดต
                            </button>
                            <a href="#" class="btn btn-danger btn-sm ms-2 me-2 delete_admin" data-id="<?php echo $id; ?>" data-bs-toggle="modal"
                                data-bs-target="#confirmDelete"> ลบ </a>
                            <button type="button" class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#changePasswordAdminModal"
                                data-id="<?php echo $id; ?>">
                                เปลี่ยนรหัสผ่าน
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

<script>
    // เมื่อ modal เปลี่ยนรหัสผ่านถูกเปิดขึ้น
    var changePasswordModal = document.getElementById('changePasswordAdminModal');
    changePasswordModal.addEventListener('show.bs.modal', function(event) {
        // ปุ่มที่ถูกกด (เปลี่ยนรหัสผ่าน)
        var button = event.relatedTarget;
        // ดึงค่า data-id
        var userId = button.getAttribute('data-id');
        // ตั้งค่า id ใน hidden input field
        var userIdInput = changePasswordModal.querySelector('#change_password_admin_id');
        userIdInput.value = userId;
    });

    // ดึงปุ่มลบหลัก และเมื่อกดจะเปิด Modal พร้อมส่งค่า id ไปยังปุ่มลบใน Modal
    document.querySelectorAll('.delete_admin').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // ดึง id ของผู้ดูแลจากปุ่มที่คลิก
            const adminId = button.getAttribute('data-id');

            // อัปเดตลิงก์ของปุ่มลบใน Modal
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            confirmDeleteBtn.href = `del_admin.php?id=${adminId}`;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const fullnameInput = document.querySelector('input[name="fullname"]');
        const usernameInput = document.querySelector('input[name="username"]');
        const passwordInput = document.getElementById('admin_password');
        const submitButton = document.querySelector('#addAdminModal .modal-footer .btn-primary');
        const addAdminModal = document.getElementById('addAdminModal');

        // ตรวจสอบข้อมูลทุกฟิลด์เมื่อ modal เปิด
        addAdminModal.addEventListener('shown.bs.modal', function() {
            validateForm(); // ตรวจสอบฟิลด์เมื่อเปิด modal
        });

        // ตรวจสอบข้อมูลเมื่อผู้ใช้พิมพ์ในแต่ละฟิลด์
        fullnameInput.addEventListener('input', validateForm);
        usernameInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        function validateForm() {
            let isValid = true;

            // ตรวจสอบฟิลด์ชื่อ-นามสกุล
            if (fullnameInput.value.trim() === '') {
                fullnameInput.classList.remove('is-valid');
                fullnameInput.classList.add('is-invalid');
                isValid = false;
            } else {
                fullnameInput.classList.remove('is-invalid');
                fullnameInput.classList.add('is-valid');
            }

            // ตรวจสอบฟิลด์ชื่อผู้ใช้
            if (usernameInput.value.trim() === '') {
                usernameInput.classList.remove('is-valid');
                usernameInput.classList.add('is-invalid');
                isValid = false;
            } else {
                usernameInput.classList.remove('is-invalid');
                usernameInput.classList.add('is-valid');
            }

            // ตรวจสอบฟิลด์รหัสผ่าน
            if (passwordInput.value.length < 6) {
                passwordInput.classList.remove('is-valid');
                passwordInput.classList.add('is-invalid');
                isValid = false;
            } else {
                passwordInput.classList.remove('is-invalid');
                passwordInput.classList.add('is-valid');
            }

            // ปิดหรือเปิดปุ่ม submit ขึ้นอยู่กับว่าข้อมูลถูกต้องหรือไม่
            submitButton.disabled = !isValid;
        }

        // รีเซ็ตฟิลด์เมื่อ modal ปิด
        addAdminModal.addEventListener('hidden.bs.modal', function() {
            fullnameInput.classList.remove('is-valid', 'is-invalid');
            usernameInput.classList.remove('is-valid', 'is-invalid');
            passwordInput.classList.remove('is-valid', 'is-invalid');
            fullnameInput.value = '';
            usernameInput.value = '';
            passwordInput.value = '';
            submitButton.disabled = true;
        });
    });
</script>

<?php include('partials/footer.php'); ?>