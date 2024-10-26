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
        <h4>ที่อยู่สำหรับจัดส่งสินค้า</h4>
        <button id="editButton" class="btn btn-danger" onclick="toggleEdit()">แก้ไขที่อยู่</button>
    </div>

    <div class="user-info d-flex align-items-center">
        <!-- ฟอร์มสำหรับแก้ไขข้อมูล -->
        <form action="<?php echo $base_url.'/user/editpage/update_address.php' ?>" id="editForm" method="POST" style="display: none;">
            <div class="mb-3">
                <label for="address" class="form-label">แก้ไขที่อยู่</label>
                
                <input type="text-area" class="form-control" name="address" value="<?php echo $row['address']; ?>"
                    required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger me-2">บันทึก</button>
                <button type="button" class="btn btn-secondary" onclick="toggleEdit()">ยกเลิก</button>
            </div>
            
        </form>
        

        <!-- แสดงผลข้อมูลปัจจุบัน -->
        <div id="userAddress">
            <h5><?php echo $row['address']; ?></h5>
        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        const form = document.getElementById('editForm');
        const info = document.getElementById('userAddress');
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
