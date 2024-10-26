<?php 
session_start(); // เปิด session ก่อนการใช้งาน $_SESSION
$update_status = $_SESSION['update_status'] ?? null; // ใช้อัพเดทสเตตัสในการเปิด modal
unset($_SESSION['update_status']); // ลบสถานะหลังจากดึงค่าแล้ว

require("../../connect.php");
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql) or die('connection failed');
$row = $result->fetch_assoc();
?>

<div class="container ms-1" style="border-radius: 5px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>เปลี่ยนรหัสผ่าน</h4>
    </div>

    <div class="user-info d-flex align-items-center">
        <!-- ฟอร์มสำหรับเปลี่ยนรหัสผ่าน -->
        <form action="<?php echo $base_url.'/user/editpage/update_pass.php' ?>" id="editForm" method="POST">
            <div class="mb-3">
                <label for="newPassword" class="form-label">รหัสผ่านใหม่</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="new_password" id="newPassword" required>
                    <span class="input-group-text" onclick="togglePasswordVisibility('newPassword', this)">
                        <i class="bi bi-eye" id="eyeIconNew"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="confirm_password" id="confirmPassword" required>
                    <span class="input-group-text" onclick="togglePasswordVisibility('confirmPassword', this)">
                        <i class="bi bi-eye" id="eyeIconConfirm"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">บันทึก</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='user_edit.php?page=infoEdit'">ยกเลิก</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal โครงสร้าง -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="statusModalLabel">
                    <?php
                    if ($update_status == 'success') {
                        echo "สำเร็จ";
                    } else {
                        echo "เกิดข้อผิดพลาด";
                    }
                    ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi <?php echo $update_status == 'success' ? 'bi-check-circle-fill text-success' : 'bi-exclamation-triangle-fill text-danger'; ?>" style="font-size: 3rem;"></i>
                <p class="mt-3">
                    <?php
                    if ($update_status == 'success') {
                        echo "เปลี่ยนรหัสผ่านสำเร็จ!";
                    } elseif ($update_status == 'mismatch') {
                        echo "โปรดยืนยันรหัสผ่านให้ตรงกัน";
                    } else {
                        echo "เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน";
                    }
                    ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.innerHTML = isPassword ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
    }

    // เปิด Modal ตามสถานะ
    document.addEventListener("DOMContentLoaded", function() {
        const updateStatus = "<?php echo $update_status; ?>";
        if (updateStatus) {
            const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
            statusModal.show();
        }
    });
</script>

<!-- Include Bootstrap Icons for eye icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
