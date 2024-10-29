<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container my-5">
    <div class="row">
        <!-- Contact Info -->
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-1 text-danger mb-3">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h4 class="card-title">โทรติดต่อ</h4>
                    <p class="card-text">เราพร้อมให้บริการทุกวันตลอด 24 ชั่วโมง 7 วันต่อสัปดาห์</p>
                    <p><strong>โทร: 02 200 5555</strong></p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-1 text-danger mb-3">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h4 class="card-title">ส่งข้อความถึงเรา</h4>
                    <p>กรอกแบบฟอร์มของเราแล้วเราจะติดต่อคุณภายใน 24 ชั่วโมง</p>
                    <p><strong>Emails: lazadowebsite@gmail.com</strong></p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4">ติดต่อเรา</h2>
                    <form id="contactForm" action="sendEmail.php" method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="name" placeholder="ชื่อ" required>
                            </div>
                            <div class="col">
                                <input type="email" class="form-control" name="email" placeholder="อีเมล" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="subject" placeholder="หัวข้อ" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="ข้อความ . . ." required></textarea>
                        </div>
                        <button type="submit" name="send" id="contact-submit" class="btn btn-danger w-100">ส่งข้อความ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">ส่งข้อความเรียบร้อยแล้ว</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ขอบคุณที่ส่งข้อความถึงเรา เราจะติดต่อคุณภายใน 24 ชั่วโมง
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div> -->

<script src="script/search_result.js"></script>
<script src="http://localhost/LazadoProject/user/script/search.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

            // ปิดการใช้งานปุ่ม submit เพื่อป้องกันการกดซ้ำ
            $('#contact-submit').prop('disabled', true);

            // แสดง loading animation
            Swal.fire({
                title: 'กำลังส่ง...',
                text: 'กรุณารอสักครู่',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: 'POST',
                url: 'sendEmail.php',
                data: $(this).serialize() + '&send=true',
                success: function(response) {
                    Swal.close(); // ปิด loading หลังจากได้รับผลลัพธ์
                    if (response === 'success') {
                        Swal.fire({
                            title: 'ส่งข้อความเรียบร้อยแล้ว!',
                            text: 'ขอบคุณที่ส่งข้อความถึงเรา เราจะติดต่อคุณภายใน 24 ชั่วโมง',
                            icon: 'success',
                            confirmButtonColor: "#dc3545",
                        });
                        $('#contactForm')[0].reset(); // รีเซ็ตฟอร์มหลังจากส่งสำเร็จ
                    } else {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาดในการส่งข้อความ!',
                            text: response, // แสดงข้อความ error จาก PHP
                            icon: 'เกิดข้อผิดพลาดในการส่งข้อความ กรุณาลองใหม่อีกครั้ง'
                        });
                    }
                    $('#contact-submit').prop('disabled', false); // เปิดใช้งานปุ่ม submit อีกครั้ง
                },
                error: function() {
                    Swal.close(); // ปิด loading หากเกิดข้อผิดพลาด
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาดในการส่งข้อความ!',
                        text: 'เกิดข้อผิดพลาดในการส่งข้อความ กรุณาลองใหม่อีกครั้ง',
                        icon: 'error'
                    });
                    $('#contact-submit').prop('disabled', false); // เปิดใช้งานปุ่ม submit อีกครั้ง
                }
            });
        });
    });
</script>

<?php include('partials/footer.php'); ?>