<?php include('partials/header.php'); ?>

<style>
    .category-item {
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 8px;
    }

    .category-item.active {
        border: 2px solid white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- Body -->
<div class="container-sm mt-5">
    <h1>จัดการสินค้า</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">เพิ่มสินค้า</button>
    <div class="d-flex float-end me-2">
        <form action="manage_product.php" method="get" class="input-group">
            <input type="text" aria-label="Search" class="form-control" placeholder="ค้นหาสินค้า" id="keyword" name="keyword">
            <button type="submit" class="input-group-text search-icon-class">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <!-- Modal for Add Product -->
    <div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="add_product.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">เพิ่มสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="order_id">

                        <!-- Product Name field -->
                        <div class="form-group mb-3">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" placeholder="กรุณาใส่ชื่อสินค้า" name="name" required>
                            <div class="invalid-feedback">
                                กรุณาใส่ชื่อสินค้า
                            </div>
                        </div>

                        <!-- Description field -->
                        <div class="form-group mb-3">
                            <label for="description">รายละเอียด</label>
                            <textarea class="form-control" name="description" placeholder="กรุณาใส่รายละเอียดสินค้า" rows="7"></textarea>
                        </div>

                        <!-- Price field -->
                        <div class="form-group mb-3">
                            <label for="price_product">ราคา</label>
                            <input type="number" class="form-control" placeholder="กรุณาใส่ราคา" name="price" required>
                        </div>

                        <!-- Product Image field -->
                        <div class="form-group mb-3">
                            <label for="product_image" class="form-label">รูปสินค้า</label>
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>

                        <!-- Product Category field -->
                        <div class="form-group mb-3">
                            <label for="product_category">หมวดหมู่สินค้า</label>
                            <select class="form-select" aria-label="category" name="category" required>
                                <option value="" selected>เลือกหมวดหมู่สินค้า</option>
                                <option value="1">คีย์บอร์ด</option>
                                <option value="2">เมาส์</option>
                                <option value="3">หูฟัง</option>
                                <option value="4">จอมอนิเตอร์</option>
                                <option value="5">เก้าอี้</option>
                                <option value="6">สตรีมมิ่ง</option>
                                <option value="7">อื่นๆ</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for Product Details -->
    <div class="modal fade" id="updateProductDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateProductDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="update_product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateProductDetailModalLabel">อัปเดตรายละเอียดสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="order_id">

                        <!-- Product Name field -->
                        <div class="form-group mb-3">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" placeholder="กรุณาใส่ชื่อสินค้า" name="name">
                        </div>

                        <!-- Description field -->
                        <div class="form-group mb-3">
                            <label for="description">รายละเอียด</label>
                            <textarea class="form-control" name="description" placeholder="กรุณาใส่รายละเอียดสินค้า" rows="7"></textarea>
                        </div>

                        <!-- Price field -->
                        <div class="form-group mb-3">
                            <label for="price_product">ราคา</label>
                            <input type="number" class="form-control" placeholder="กรุณาใส่ราคา" name="price">
                        </div>

                        <!-- Product Image field -->
                        <div class="form-group mb-3">
                            <label for="product_image" class="form-label">รูปสินค้า</label>
                            <input class="form-control" type="file" name="img">
                        </div>

                        <!-- Product Category field -->
                        <div class="form-group mb-3">
                            <label for="product_category">หมวดหมู่สินค้า</label>
                            <select class="form-select" aria-label="category" name="category">
                                <option selected>เลือกหมวดหมู่สินค้า</option>
                                <option value="1">คีย์บอร์ด</option>
                                <option value="2">เมาส์</option>
                                <option value="3">หูฟัง</option>
                                <option value="4">จอมอนิเตอร์</option>
                                <option value="5">เก้าอี้</option>
                                <option value="6">สตรีมมิ่ง</option>
                                <option value="7">อื่นๆ</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary">อัปเดตสินค้า</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Icon หมวดหมู่-->
<section class="container">
    <div class="row text-center">
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'manage_product.php?c=keyboard') ? 'active' : ''; ?>"
                onclick="window.location.href='manage_product.php?c=keyboard'">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'manage_product.php?c=mouse') ? 'active' : ''; ?>"
                onclick="window.location.href='manage_product.php?c=mouse'">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'manage_product.php?c=headset') ? 'active' : ''; ?>"
                onclick="window.location.href='manage_product.php?c=headset'">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'manage_product.php?c=monitor') ? 'active' : ''; ?>"
                onclick="window.location.href='manage_product.php?c=monitor'">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'manage_product.php?c=chair') ? 'active' : ''; ?>"
                onclick="window.location.href='manage_product.php?c=chair'">
                <i class="bi bi-chair" style="font-size: 2rem;"><img
                        src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg"
                        style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'manage_product.php?c=streaming') ? 'active' : ''; ?>"
                onclick="window.location.href='manage_product.php?c=streaming'">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Streaming</p>
            </div>
        </div>
    </div>

    <div class="row search-container">
        <?php
        $c = '';
        $keyword = '';
        $sql = "SELECT * FROM products";

        if (isset($_GET["c"])) {
            $c = $_GET['c'];
        }
        if (isset($_GET["keyword"])) {
            $keyword = $_GET['keyword'];
            $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
        }

        if ($c == 'keyboard') {
            $sql = 'SELECT * FROM products WHERE category=1';
        } elseif ($c == 'mouse') {
            $sql = 'SELECT * FROM products WHERE category=2';
        } elseif ($c == 'headset') {
            $sql = 'SELECT * FROM products WHERE category=3';
        } elseif ($c == 'monitor') {
            $sql = 'SELECT * FROM products WHERE category=4';
        } elseif ($c == 'chair') {
            $sql = 'SELECT * FROM products WHERE category=5';
        } elseif ($c == 'streaming') {
            $sql = 'SELECT * FROM products WHERE category=6';
        }

        $result = mysqli_query($conn, $sql);
        $numrows = $result->num_rows;
        ?>
        <h4>ผลลัพธ์การค้นหา: <?php echo $numrows ?> รายการ </h4>
        <div class="container my-5">
            <div class="row">
                <?php
                $c = '';
                $keyword = '';
                $sql = "SELECT * FROM products";
                if (isset($_GET["c"])) {
                    $c = $_GET['c'];
                }
                if (isset($_GET["keyword"])) {
                    $keyword = $_GET['keyword'];
                    $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
                }

                if ($c == 'keyboard') {
                    $sql = 'SELECT * FROM products WHERE category=1';
                } elseif ($c == 'mouse') {
                    $sql = 'SELECT * FROM products WHERE category=2';
                } elseif ($c == 'headset') {
                    $sql = 'SELECT * FROM products WHERE category=3';
                } elseif ($c == 'monitor') {
                    $sql = 'SELECT * FROM products WHERE category=4';
                } elseif ($c == 'chair') {
                    $sql = 'SELECT * FROM products WHERE category=5';
                } elseif ($c == 'streaming') {
                    $sql = 'SELECT * FROM products WHERE category=6';
                }

                $result = mysqli_query($conn, $sql);
                ?>
                <?php
                // Loop ข้อมูลแต่ละแถวในฐานข้อมูล
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-lg-3 mb-4">
                            <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                                <div class="card-body">
                                    <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <div class="card-text text-danger" style="font-weight: bold; font-size: 20px;">
                                        <?php echo "฿" . number_format($row['price'], 2); ?>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateProductDetailModal"
                                        data-id="<?php echo $row['id']; ?>"
                                        data-name="<?php echo $row['name']; ?>"
                                        data-description="<?php echo $row['description']; ?>"
                                        data-price="<?php echo $row['price']; ?>"
                                        data-img="<?php echo $row['img']; ?>"
                                        data-category="<?php echo $row['category']; ?>">
                                        อัปเดต
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "ไม่พบข้อมูล";
                }
                ?>
            </div>
        </div>
    </div>
</section>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- <script src="search_admin.js"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var updateProductModal = document.getElementById('updateProductDetailModal');

        updateProductModal.addEventListener('show.bs.modal', function(event) {
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

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    document.addEventListener('DOMContentLoaded', function() {
        var addProductModal = document.getElementById('addProductModal');

        addProductModal.addEventListener('hidden.bs.modal', function() {
            // Reset the form fields within the Add Product modal
            var form = addProductModal.querySelector('form');
            form.reset();
            form.classList.remove('was-validated'); // Remove validation classes
        });
    });
</script>

<?php include('partials/footer.php'); ?>