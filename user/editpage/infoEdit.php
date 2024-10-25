<?php
session_start();
require("../../connect.php");
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql) or die('connection failed');
$row = $result->fetch_assoc();
?>

<div class="container ms-1" style="border-radius: 5px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>ข้อมูลส่วนตัว</h4>
        <button id="editButton" class="btn btn-edit" onclick="toggleEdit()">แก้ไขข้อมูลส่วนตัว</button>
    </div>

    <div class="user-info d-flex align-items-center">
        <!-- ฟอร์มสำหรับแก้ไขข้อมูล -->
        <form action="<?php echo $base_url.'/user/editpage/update_info.php' ?>" id="editForm" method="POST" style="display: none;">
            <div class="mb-3">
                <label for="fullname" class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" onclick="toggleEdit()">ยกเลิก</button>
        </form>

        <!-- แสดงผลข้อมูลปัจจุบัน -->
        <div id="userInfo">
            <h5><?php echo $row['fullname']; ?></h5>
            <p><?php echo $row['email']; ?></p>
        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        const form = document.getElementById('editForm');
        const info = document.getElementById('userInfo');
        const editButton = document.getElementById('editButton');

        if (form.style.display === 'none') {
            form.style.display = 'block';
            info.style.display = 'none';
            editButton.style.display = 'none';
        } else {
            form.style.display = 'none';
            info.style.display = 'block';
            editButton.style.display = 'inline-block';
        }
    }
</script>
