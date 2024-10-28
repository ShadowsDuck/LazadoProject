<?php

ob_start(); // เริ่มการ buffer output

include('partials/header.php');
$update_status = $_SESSION['update_status'] ?? ''; //เอาไว้ใช้กับmodalกดบันทึกรหัส
unset($_SESSION['update_status']);

$update_status_info = $_SESSION['update_status_info'] ?? ''; //เอาไว้ใช้กับmodalกดบันทึกข้อมูล
unset($_SESSION['update_status_info']);

$update_status_address = $_SESSION['update_status_address'] ?? ''; //เอาไว้ใช้กับmodalกดบันทึกที่อยู่จัดส่ง
unset($_SESSION['update_status_address']);

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['id']) || !isset($_SESSION['usertype'])) {
    header("Location: {$base_url}/login/login.php");
    exit(); // ป้องกันการดำเนินการโค้ดต่อไป
}

ob_end_flush(); // ปิดการ buffer output
?>

<!-- CSS -->
<link rel="stylesheet" href="./CSS/user_edit_style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .swal2-popup .swal2-styled:focus {
        box-shadow: none !important;
    }
</style>

<div class="container mt-5  " style="margin-bottom:300px;">
    <div class="row ">
        <!-- Sidebar -->
        <div class="col-sm-3 sidebar vh-auto" id="sidebar">
            <a class="nav-link" href="user_edit.php?page=infoEdit" data-page="editpage/infoEdit.php">ข้อมูลส่วนตัว</a>
            <a class="nav-link" href="user_edit.php?page=addressEdit" data-page="editpage/addressEdit.php">ที่อยู่สำหรับจัดส่ง</a>
            <a class="nav-link" href="user_edit.php?page=orderStatusEdit" data-page="editpage/orderStatusEdit.php">สถานะสินค้าของฉัน</a>
            <a class="nav-link" href="user_edit.php?page=passEdit" data-page="editpage/passEdit.php">เปลี่ยนรหัสผ่าน</a>
            <a href="user_edit.php?logout=1" style="margin:0; padding:0; " id="buttonLogout"><button type="button" class="buttonlogout btn btn-danger my-2 mx-0 py-2 w-100 ">
                    <p>ออกจากระบบ</p>
                </button></a>
        </div>

        <!-- Main Content -->
        <div class="col-sm-9 ">
            <div class="cus rounded-sm " style="margin-left:3rem; background-color:#f8f9fa; border-radius: 5px;">
                <div id="sidebar-content" class="p-3">
                    <!-- เนื้อหาจะถูกโหลดมาแสดงที่นี่ -->
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Script สำหรับการจัดการ Sidebar Content
    $(document).ready(function() {
        // Handle sidebar content loading
        $('#sidebar .nav-link').click(function(e) {
            e.preventDefault();
            var page = $(this).data('page');

            // Load content and handle errors
            $('#sidebar-content').load(page, function(response, status, xhr) {
                if (status == "error") {
                    $('#sidebar-content').html("<p>ไม่สามารถโหลดเนื้อหาได้</p>");
                    console.error("Error loading page:", xhr.status, xhr.statusText);
                }
            });

            // Mark the clicked link as active
            $('#sidebar .nav-link').removeClass('active');
            $(this).addClass('active');
        });


        //Automatically select the first sidebar item if the page is "aboutpage/aboutSidebar.php"
        if (window.location.href.indexOf("infoEdit") > -1) {
            $('#sidebar .nav-link').first().trigger('click');
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (isset($update_status_info) && $update_status_info): ?>
            Swal.fire({
                title: "อัพเดตข้อมูลส่วนตัว",
                text: "ข้อมูลของคุณถูกบันทึกเรียบร้อย!",
                icon: "success",
                confirmButtonText: "ตกลง",
                confirmButtonColor: '#dc3545'
            });
        <?php endif; ?>
    });

    document.addEventListener("DOMContentLoaded", function() {
        <?php if (isset($update_status_address) && $update_status_address): ?>
            Swal.fire({
                title: "อัพเดตข้อมูลที่อยู่",
                text: "ข้อมูลของคุณถูกบันทึกเรียบร้อย!",
                icon: "success",
                confirmButtonText: "ตกลง",
                confirmButtonColor: '#dc3545'
            });
        <?php endif; ?>
    });

    document.addEventListener("DOMContentLoaded", function() {
        <?php if (isset($update_status)): ?>
            let title, text, icon;
            switch ("<?php echo $update_status; ?>") {
                case 'success':
                    title = "อัพเดตรหัสผ่าน";
                    text = "เปลี่ยนรหัสผ่านสำเร็จ!";
                    icon = "success";
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: "ตกลง",
                        confirmButtonColor: '#dc3545'
                    });
                    break;
                case 'error':
                    title = "เกิดข้อผิดพลาด";
                    text = "รหัสผ่านเดิมไม่ถูกต้อง!";
                    icon = "error";
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: "ตกลง",
                        confirmButtonColor: '#dc3545'
                    });
                    break;
                case 'mismatch':
                    title = "เกิดข้อผิดพลาด";
                    text = "โปรดยืนยันรหัสผ่านให้ตรงกัน";
                    icon = "warning";
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: "ตกลง",
                        confirmButtonColor: '#dc3545'
                    });
                    break;
                case 'short_password':
                    title = "เกิดข้อผิดพลาด";
                    text = "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร";
                    icon = "warning";
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: "ตกลง",
                        confirmButtonColor: '#dc3545'
                    });
                    break;
            }
        <?php endif; ?>
    });
</script>

<?php include('partials/footer.php'); ?>