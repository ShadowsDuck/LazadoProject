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

document.addEventListener('DOMContentLoaded', function () {
    var addProductModal = document.getElementById('addProductModal');

    addProductModal.addEventListener('hidden.bs.modal', function () {
        // Reset the form fields within the Add Product modal
        var form = addProductModal.querySelector('form');
        form.reset();
        form.classList.remove('was-validated'); // Remove validation classes
    });
});