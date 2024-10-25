<?php
include('partials/header.php');
?>


<style>
    body {
        background-color: #f8f9fa;
    }

    .sidebar {
        background-color: #fff;
        border-right: 1px solid #e0e0e0;
        min-height: auto;
        padding-top: 20px;
    }

    .sidebar a  {
        color: #333;
        font-weight: bold;
        display: block;
        padding: 10px 20px;
        text-decoration: none;
    }
    .btn{
        color: #333;
        font-weight: bold;
        display: block;
        padding: 10px 20px;
        text-decoration: none;
        
    }

    .sidebar a.active,
    .sidebar a:hover {
        background-color: #f5f5f5;
        color: red;
    }

    .user-info {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .btn-edit {
        background-color: #f8d7da;
        color: red;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-edit:hover {
        background-color: #f5c2c7;
    }

    .status-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        padding: 10px;
        text-align: center;
        border-radius: 8px;
    }

    .status-card p {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .status-card span {
        display: block;
        font-size: 14px;
        color: #888;
    }

    .user-details {
        margin-top: 20px;
    }

    .user-details .detail-item {
        margin-bottom: 10px;
    }

    .user-details .detail-item span {
        color: #888;
    }
</style>


<div class="container">
    <div class="row ">
        <!-- Sidebar -->
        <div class="col-sm-3 sidebar vh-auto" id="sidebar">
            <a class="nav-link" href="user_edit.php?page=infoEdit" data-page="editpage/infoEdit.php">ข้อมูลส่วนตัว</a>
            <a class="nav-link" href="user_edit.php?page=addressEdit" data-page="editpage/addressEdit.php">ที่อยู่สำหรับจัดส่ง</a>
            <a class="nav-link" href="user_edit.php?page=payEdit" data-page="editpage/payEdit.php">ช่องทางชำระเงิน</a>
            <a class="nav-link" href="user_edit.php?page=passEdit" data-page="editpage/passEdit.php">เปลี่ยนรหัสผ่าน</a>
            <a href="user_edit.php?logout=1" style="margin:0; padding:0;"><button type="button" class="btn btn-danger my-2 mx-3 py-2">ออกจากระบบ</button></a>
        </div>

        <!-- Main Content -->

        <div class="col-sm-9 ">
            <div class="cus rounded-sm " style="margin-left:3rem; background-color:#f8f9fa;">
                <div id="sidebar-content" class="p-3">
                    <!-- เนื้อหาจะถูกโหลดมาแสดงที่นี่ -->
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        // Automatically select the first sidebar item if the page is "aboutpage/aboutSidebar.php"
        if (window.location.href.indexOf("infoEdit") > -1) {
            $('#sidebar .nav-link').first().trigger('click');
        }
    });
</script>


<?php
include('partials/footer.php');
?>