<?php include('partials/header.php'); ?>

<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-light vh-auto " id="sidebar">
            <div class="nav flex-column nav-pills p-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="about.php?page=aboutSidebar" data-page="aboutpage/aboutSidebar.php"><i class="bi bi-info-circle"></i> เกี่ยวกับเรา</a>
                <a class="nav-link" href="about.php?page=contactSidebar" data-page="aboutpage/contactSidebar.php"><i class="bi bi-telephone"></i> ติดต่อเรา</a>
                <a class="nav-link" href="about.php?page=termsSidebar" data-page="aboutpage/termsSidebar.php"><i class="bi bi-file-earmark-text"></i> ข้อกำหนดและเงื่อนไข</a>
                <a class="nav-link" href="about.php?page=policySidebar" data-page="aboutpage/policySidebar.php"><i class="bi bi-shield-lock"></i> นโยบายความเป็นส่วนตัว</a>

                <hr>
                <p>บริการลูกค้า</p>
                <a class="nav-link" href="about.php?page=shippingSidebar" data-page="aboutpage/shippingSidebar.php"><i class="bi bi-truck"></i> การจัดส่งสินค้า</a>
                <a class="nav-link" href="about.php?page=guaranteeSidebar" data-page="aboutpage/guaranteeSidebar.php"><i class="bi bi-shield-check"></i> การรับประกันสินค้า</a>
                <a class="nav-link" href="about.php?page=cancelSidebar" data-page="aboutpage/cancelSidebar.php"><i class="bi bi-x-circle"></i> การยกเลิกการสั่งซื้อสินค้า</a>
                <a class="nav-link" href="about.php?page=returnSidebar" data-page="aboutpage/returnSidebar.php"><i class="bi bi-arrow-return-left"></i> การคืนสินค้าและการคืนเงิน</a>
            </div>
        </div>

        <!-- Content Area -->

        <div class="col-md-9 ">
            <div class="cus" style="margin-left:3rem; background-color:#f8f9fa;">
                <div id="sidebar-content" class="p-3">
                    <!-- เนื้อหาจะถูกโหลดมาแสดงที่นี่ -->
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Script สำหรับการจัดการ Sidebar Content
    $(document).ready(function() {
        $('#sidebar .nav-link').click(function(e) { // เจาะจงให้ทำงานใน #sidebar เท่านั้น
            e.preventDefault();
            var page = $(this).data('page'); // รับค่าจาก data-page เช่น aboutpage/contactSidebar.php

            // โหลดเนื้อหาจากไฟล์ที่กำหนด และเพิ่ม error handling
            $('#sidebar-content').load(page, function(response, status, xhr) {
                if (status == "error") {
                    $('#sidebar-content').html("<p>ไม่สามารถโหลดเนื้อหาได้</p>");
                    console.error("Error loading page:", xhr.status, xhr.statusText);
                }
            });
        });
    });
</script>
<?php include('partials/footer.php'); ?>