document.addEventListener('DOMContentLoaded', function () {
    var updateProductModal = document.getElementById('updateProductDetailModal');

    updateProductModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        // ดึงข้อมูลจากปุ่ม
        var productId = button.getAttribute('data-id');
        var productName = button.getAttribute('data-name');
        var productDescription = button.getAttribute('data-description');
        var productPrice = button.getAttribute('data-price');
        var productDiscount = button.getAttribute('data-discount');
        var productDiscountedPrice = button.getAttribute('data-discounted_price');
        var productImg = button.getAttribute('data-file');
        var productCategory = button.getAttribute('data-category');
        var productAvailable = button.getAttribute('data-available');

        // เติมข้อมูลลงในฟอร์มในโมดาล
        var modal = this;
        modal.querySelector('#order_id').value = productId;
        modal.querySelector('input[name="name"]').value = productName;
        modal.querySelector('textarea[name="description"]').value = productDescription;
        modal.querySelector('input[name="price"]').value = productPrice;
        modal.querySelector('#product_image_preview').src = '../uploads/' + productImg;
        modal.querySelector('select[name="category"]').value = productCategory;
        modal.querySelector('select[name="available"]').value = productAvailable;

        // ตั้งค่าและเปิด/ปิดช่อง "ราคาที่ลดแล้ว" ตามส่วนลด
        var discountSelect = modal.querySelector('#discountSelect');
        var discountedPriceInput = modal.querySelector('#discountedPriceInput');

        // ตั้งค่าช่องส่วนลด
        discountSelect.value = productDiscount;
        discountedPriceInput.value = productDiscountedPrice;

        // เปิด/ปิดช่อง "ราคาที่ลดแล้ว" ตามส่วนลด
        if (productDiscount === "1") {
            discountedPriceInput.disabled = false; // เปิดให้กรอกข้อมูล
            discountedPriceInput.placeholder = "กรุณาใส่ราคาที่ลดแล้ว";
        } else {
            discountedPriceInput.disabled = true; // ปิดไม่ให้กรอกข้อมูล
            discountedPriceInput.value = ""; // ล้างค่าในช่อง
            discountedPriceInput.placeholder = "ไม่สามารถใส่ราคาได้";
        }
    });

    // กำหนดการทำงานเมื่อเปลี่ยนค่าใน select ส่วนลด
    document.getElementById('discountSelect').addEventListener('change', function () {
        var discountedPriceInput = document.getElementById('discountedPriceInput');
        if (this.value === "1") {
            discountedPriceInput.disabled = false;
            discountedPriceInput.placeholder = "กรุณาใส่ราคาที่ลดแล้ว";
        } else {
            discountedPriceInput.disabled = true;
            discountedPriceInput.value = "";
            discountedPriceInput.placeholder = "ไม่สามารถใส่ราคาได้";
        }
    });
});

// สคริปต์สำหรับรีเซ็ตฟอร์มใน "Add Product" modal เมื่อปิดหน้าต่าง
document.addEventListener('DOMContentLoaded', function () {
    var addProductModal = document.getElementById('addProductModal');

    addProductModal.addEventListener('hidden.bs.modal', function () {
        // รีเซ็ตฟิลด์ในฟอร์มของ Add Product modal
        var form = addProductModal.querySelector('form');
        form.reset();
        form.classList.remove('was-validated'); // ลบคลาสการตรวจสอบข้อมูล
    });
});

// ดึงปุ่มลบและเรียก SweetAlert เมื่อกดปุ่มลบ
document.querySelectorAll('.delete_product').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault(); // ป้องกันการรีเฟรชหน้า

        // ดึง id ของผู้ดูแลจากปุ่มที่คลิก
        const productId = button.getAttribute('data-id');

        // แสดง SweetAlert สำหรับยืนยันการลบ
        Swal.fire({
            title: "คุณแน่ใจใช่ไหม?",
            text: "หลังจากลบไปแล้วคุณไม่สามารถกู้คืนข้อมูลได้",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ลบมัน!",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                // หากผู้ใช้ยืนยัน จะทำการลบ
                window.location.href = `del_product.php?id=${productId}`;

                Swal.fire(
                    "ลบสำเร็จ!",
                    "ข้อมูลถูกลบเรียบร้อยแล้ว.",
                    "success"
                );
            }
        });
    });
});