<?php include('partials/header.php'); ?>
<style>.nav-pills .nav-link {
    color: #1d0507; /* สีตัวอักษรแดง */
    background-color: #f8f9fa; /* สีพื้น */
}

.nav-pills .nav-link.active {
    color: #fff; /* สีตัวอักษรขาวเมื่อเลือก */
    background-color: #c82333; /* สีพื้นหลังเข้มขึ้นเมื่อเลือก */
}

.nav-pills .nav-link:hover {
    background-color: #e0818a /* สีพื้นหลังเมื่อเอาเมาส์ชี้ */
}</style>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-light  rounded-3" id="sidebar"  style="min-height: 600px;">
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
            <div class="cus rounded-3" style="margin-left:3rem; background-color:#f8f9fa;">
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
    if (window.location.href.indexOf("aboutSidebar") > -1) {
        $('#sidebar .nav-link').first().trigger('click');
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php include('partials/footer.php'); ?>