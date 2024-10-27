<?php include('partials/header.php'); ?>

<!-- Body -->

<!-- Modal for add to cart -->
<div class="container-add-to-cart">
    <div class="modal fade" id="modalAddCart" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icons">
                        <i class="icon bi bi-check-lg"></i>
                    </div>
                    <h4 class="modal-title">เพิ่มสินค้า</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>คุณต้องการเพิ่มสินค้าไปยังตะกร้า?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <a href="#" id="confirmAdd" class="btn btn-danger ">เพิ่มสินค้า</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <!-- Category Menu -->
        <div class="col-md-3">
            <div class="category-menu">
                <a href="allitem.php">Gaming Gear<i class="bi bi-chevron-right"></i></a>
                <a href="allitem.php?c=keyboard">Keyboard</a>
                <a href="allitem.php?c=mouse">Mouse</a>
                <a href="allitem.php?c=headset">Headset</a>
                <a href="allitem.php?c=monitor">Monitor</a>
                <a href="allitem.php?c=chair">Chair</a>
                <a href="allitem.php?c=streaming">Streaming</a>
                <a href="allitem.php?c=other">Other<i class="bi bi-chevron-right"></i></a>
            </div>
        </div>

        <!-- Carousel -->
        <div class="col-md-9">
            <div id="topCarousel" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#topCarousel" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#topCarousel" data-bs-slide-to="1"></li>
                    <li data-bs-target="#topCarousel" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://yt3.googleusercontent.com/NvH3G0-twMfxjeJLZOQvmaJ5loWfS6hOfIKPv2M_Gh5r3b7nLo8IljtEdjH_Ga27xxRtrErD=s900-c-k-c0x00ffffff-no-rj" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://s.isanook.com/ns/0/ui/1586/7930818/gal-7930818-20191022051920-a6757b1.jpg" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="image/product/453221908_405973229124928_6954447741468252783_n.jpg" alt="Slide 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#topCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#topCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <h2 class="text-center mb-4">โปรโมชั่นประจำเดือน</h2>
    <div class="d-flex justify-content-between align-items-center">
        <div class="container mb-4">
            <div class="row">
                <?php

                $sql1 = "SELECT * FROM products WHERE discount = 1";
                $result1 = mysqli_query($conn, $sql1);

                if ($result1->num_rows > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                        <div class="col col-md-3 mb-4">
                            <div class="card h-100">
                                <!-- body -->
                                <div class="card-body" style="cursor: pointer;"
                                    onclick="window.location.href='item_details.php?id=<?php echo $row1['id'] ?>'">
                                    <?php
                                    $imageURL = !empty($row1['file_name']) ? '../uploads/' . $row1['file_name'] : 'https://placehold.co/200';
                                    ?>
                                    <img src="<?php echo $imageURL ?>" class="card-img-top mb-3" alt="Image" width="200px" loading="lazy">
                                    <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                                        <?php echo $row1['name']; ?></h4>
                                </div>

                                <!-- footer -->
                                <div class="card-footer d-flex justify-content-between align-items-center" style="background-color:white; border-top:none;">
                                    <div>
                                        <div class="card-text">
                                            <p style="text-decoration: line-through; margin:0; font-size: 12px;"><?php echo "฿" . number_format($row1['price'], 2); ?></p>
                                            <p style="margin:0; font-size: 20px; color:red;"><?php echo "฿" . number_format($row1['discounted_price'], 2); ?></p>
                                        </div>
                                    </div>

                                    <button class="btn addCart"
                                        onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAddCart"
                                        data-id="<?php echo $row1['id'] ?>">
                                        <i style="color:red;" class="bi bi-cart3 h4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo 'ไม่พบข้อมูล';
                } ?>
            </div>
        </div>
    </div>


    <section class="container my-5">
        <h2 class="text-center mb-4">สินค้าขายดีประจำเดือน</h2>
        <div class="row">
            <?php
            // Query all featured products in one go
            $result = mysqli_query($conn, "SELECT * FROM products WHERE id IN (3, 4, 5, 7)");

            // Loop through each product
            while ($row = mysqli_fetch_assoc($result)) {
                $imageURL = !empty($row['file_name']) ? '../uploads/' . $row['file_name'] : 'https://placehold.co/200';
            ?>
                <div class="col col-md-3 mb-4">
                    <div class="card h-100">
                        <!-- Card body with click-to-details -->
                        <div class="card-body" style="cursor: pointer;" onclick="window.location.href='item_details.php?id=<?php echo $row['id'] ?>'">
                            <img src="<?php echo $imageURL ?>" class="card-img-top mb-3" alt="Image" width="200px" loading="lazy">
                            <h4 class="card-title" style="font-weight:600; font-size:0.8rem;">
                                <?php echo $row['name']; ?>
                            </h4>
                        </div>

                        <!-- Card footer with price and add-to-cart button -->
                        <div class="card-footer d-flex justify-content-between align-items-center" style="background-color:white; border-top:none;">

                            <?php if ($row['discount'] == 1) { ?>
                                <div class="card-text">
                                    <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;">
                                        <?php echo "฿" . number_format($row['price'], 2); ?>
                                    </p>
                                    <p style="margin:0; font-size: 20px; color:red;">
                                        <?php echo "฿" . number_format($row['discounted_price'], 2); ?>
                                    </p>
                                </div>

                            <?php } else { ?>
                                <div class="card-text" style="font-size: 20px; color:black;">
                                    <?php echo "฿" . number_format($row['price'], 2); ?>
                                </div>
                            <?php } ?>


                            <button class="btn addCart"
                                onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAddCart"
                                data-id="<?php echo $row['id'] ?>">
                                <i style="color:red;" class="bi bi-cart3 h4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <!-- View All Products Button -->
    <div class="text-center mt-4">
        <a href="allitem.php" class="btn btn-danger">View All Products</a>
    </div>

</div>

<div class="container mt-5">
    <div id="bottomCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bottomCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#bottomCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#bottomCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/product/394631396_240848385637414_4855002469686348029_n.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/product/394631396_240848385637414_4855002469686348029_n.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/product/394631396_240848385637414_4855002469686348029_n.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bottomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bottomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Browse By Category Section -->
<section class="container my-5">
    <h2 class="text-center mb-4">Browse By Category</h2>
    <div class="row text-center">
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=keyboard'" style="cursor: pointer;">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=mouse'" style="cursor: pointer;">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=headset'" style="cursor: pointer;">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=monitor'" style="cursor: pointer;">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=chair'" style="cursor: pointer;">
                <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg" style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=streaming'" style="cursor: pointer;">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Streaming</p>
            </div>
        </div>
    </div>
</section>


<script src="script/flash_sale.js"></script>
<script src="script/search.js"></script>
<script src="script/search_result.js"></script>
<script>
    // ดึงปุ่มเพิ่ม และเมื่อกดจะเปิด Modal พร้อมส่งค่า id ไปยังปุ่มเพิ่มใน Modal
    document.querySelectorAll('.addCart').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // ดึง id สินค้า
            const productId = button.getAttribute('data-id');

            // อัปเดตลิงก์ของปุ่มลบใน Modal
            const confirmDeleteBtn = document.getElementById('confirmAdd');
            confirmDeleteBtn.href = `add_to_cart.php?id=${productId}`;
        });
    });
</script>

<?php include('partials/footer.php'); ?>