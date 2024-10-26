document.addEventListener('DOMContentLoaded', function () {
    var updateProductModal = document.getElementById('updateProductDetailModal');

    updateProductModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        // ดึงข้อมูลจากปุ่ม
        var productId = button.getAttribute('data-id');
        var productName = button.getAttribute('data-name');
        var productDescription = button.getAttribute('data-description');
        var productPrice = button.getAttribute('data-price');
        var productImg = button.getAttribute('data-img');
        var productCategory = button.getAttribute('data-category');

        // เติมข้อมูลลงในฟอร์มในโมดาล
        var modal = this;
        modal.querySelector('#order_id').value = productId;
        modal.querySelector('input[name="name"]').value = productName;
        modal.querySelector('textarea[name="description"]').value = productDescription;
        modal.querySelector('input[name="price"]').value = productPrice;

        // กำหนดค่าให้กับ input file (ไม่สามารถตั้งค่าได้โดยตรง)
        // ดังนั้นไม่จำเป็นต้องทำอะไรกับ `img` ที่นี่เว้นแต่ต้องการแสดงภาพปัจจุบัน

        // ตั้งค่าหมวดหมู่สินค้า
        var categorySelect = modal.querySelector('select[name="category"]');
        categorySelect.value = productCategory;
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

// สคริปต์สำหรับตั้งค่าลิงก์การลบสินค้าใน Modal ยืนยันการลบเมื่อคลิกปุ่มลบสินค้า
document.querySelectorAll('.delete_product').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();

        // ดึง id ของสินค้าจากปุ่มที่คลิก
        const productId = button.getAttribute('data-id');

        // ตั้งค่า href สำหรับปุ่มลบใน Modal
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.href = `del_product.php?id=${productId}`;
    });
});