<?php include('partials/header.php'); ?>

<style>
    .btn-vsm {
        padding: 0.2rem 0.4rem;
        font-size: 0.75rem;
    }
</style>

<!-- Body -->
<div class="container-sm mt-5">
    <!-- Alert message should be displayed right here -->
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show alert-overlay" id="session-alert" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

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
                <form action="add_product.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                            <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png">
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
                        <button type="submit" class="btn btn-primary" name="addProduct">เพิ่มสินค้า</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal for Update Product Details -->
    <div class="modal fade" id="updateProductDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateProductDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="update_product.php" method="post" enctype="multipart/form-data">
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
                            <img id="product_image_preview" src="" alt="Current Image" class="img-thumbnail mb-2" style="max-width: 200px; display:flex;">
                            <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png">
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

    <!-- Modal for Confirm Delete -->
    <div class="container-delete">
        <div class="modal fade" id="confirmDelete" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icons">
                            <i class="icon">&times;</i>
                        </div>
                        <h4 class="modal-title">คุณแน่ใจใช่ไหม?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>คุณแน่ใจใช่ไหมที่จะลบผู้ดูแลคนนี้? <br>หลังจากลบไปแล้วคุณไม่สามารถกู้คืนข้อมูลได้</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <a href="#" class="btn btn-danger" id="confirmDeleteBtn">ลบ</a>
                    </div>
                </div>
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
        $sql = "SELECT * FROM products ORDER BY created_at DESC";

        if (isset($_GET["c"])) {
            $c = $_GET['c'];
        }
        if (isset($_GET["keyword"])) {
            $keyword = $_GET['keyword'];
            $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' ORDER BY created_at DESC";
        }

        if ($c == 'keyboard') {
            $sql = "SELECT * FROM products WHERE category=1 ORDER BY created_at DESC";
        } elseif ($c == 'mouse') {
            $sql = "SELECT * FROM products WHERE category=2 ORDER BY created_at DESC";
        } elseif ($c == 'headset') {
            $sql = "SELECT * FROM products WHERE category=3 ORDER BY created_at DESC";
        } elseif ($c == 'monitor') {
            $sql = "SELECT * FROM products WHERE category=4 ORDER BY created_at DESC";
        } elseif ($c == 'chair') {
            $sql = "SELECT * FROM products WHERE category=5 ORDER BY created_at DESC";
        } elseif ($c == 'streaming') {
            $sql = "SELECT * FROM products WHERE category=6 ORDER BY created_at DESC";
        }

        $result = mysqli_query($conn, $sql);
        $numrows = $result->num_rows;
        ?>
        <h4>ผลลัพธ์การค้นหา: <?php echo $numrows ?> รายการ </h4>
        <div class="container my-5">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col col-md-2 mb-4">
                            <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                                <div class="card-body">
                                    <?php
                                    $imageURL = !empty($row['file_name']) ? '../uploads/' . $row['file_name'] : 'https://placehold.co/200';
                                    ?>
                                    <img src="<?php echo $imageURL ?>" class="card-img-top mb-3" alt="Image" width="200px">
                                    <h5 class="card-title" style="font-weight:600; font-size:0.8rem;"><?php echo $row['name']; ?></h5>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <div class="card-text text-danger" style="font-weight: bold; font-size: 1rem;">
                                        <?php echo "฿" . number_format($row['price'], 2); ?>
                                    </div>
                                    <div class="d-flex justify-content-end ms-auto">
                                        <button type="button" class="btn btn-success btn-vsm me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#updateProductDetailModal"
                                            data-id="<?php echo $row['id']; ?>"
                                            data-name="<?php echo $row['name']; ?>"
                                            data-description="<?php echo $row['description']; ?>"
                                            data-price="<?php echo $row['price']; ?>"
                                            data-file="<?php echo $row['file_name']; ?>"
                                            data-category="<?php echo $row['category']; ?>">
                                            อัปเดต
                                        </button>
                                        <a href="#" class="btn btn-danger btn-vsm delete_product" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#confirmDelete"> ลบ </a>
                                    </div>
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

<?php include('partials/footer.php'); ?>