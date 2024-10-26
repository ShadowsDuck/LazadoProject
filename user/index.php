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
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://yt3.googleusercontent.com/NvH3G0-twMfxjeJLZOQvmaJ5loWfS6hOfIKPv2M_Gh5r3b7nLo8IljtEdjH_Ga27xxRtrErD=s900-c-k-c0x00ffffff-no-rj" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://s.isanook.com/ns/0/ui/1586/7930818/gal-7930818-20191022051920-a6757b1.jpg" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+3" alt="Slide 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
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
                // ดึงข้อมูลจากตาราง discount และ products โดยใช้ INNER JOIN เพื่อเชื่อมโยงข้อมูลทั้งสองตารางเข้าด้วยกันโดยมีเงื่อนไขที่ว่า discount.product_id ต้องเท่ากับ products.id
                $sql1 = "SELECT * FROM products WHERE discount = 1";
                $result1 = mysqli_query($conn, $sql1);

                if ($result1->num_rows > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                        <div class="col col-md-3 mb-4">
                            <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                                <!-- body -->
                                <div class="card-body" style="cursor: pointer;"
                                    onclick="window.location.href='item_details.php?id=<?php echo $row1['id'] ?>'">
                                    <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                                    <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                                        <?php echo $row1['name']; ?></h4>
                                </div>

                                <!-- footer -->
                                <div class="card-footer d-flex justify-content-between align-items-center">
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
            $result1 = mysqli_query($conn, "SELECT * FROM products WHERE id = 3");
            $result2 = mysqli_query($conn, "SELECT * FROM products WHERE id = 4");
            $result3 = mysqli_query($conn, "SELECT * FROM products WHERE id = 5");
            $result4 = mysqli_query($conn, "SELECT * FROM products WHERE id = 11");

            $row1 = mysqli_fetch_assoc($result1);
            $row2 = mysqli_fetch_assoc($result2);
            $row3 = mysqli_fetch_assoc($result3);
            $row4 = mysqli_fetch_assoc($result4);
            ?>
            <!-- Product 1 -->
            <div class="col col-md-3 mb-4">
                <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                    <!-- body -->
                    <div class="card-body" style="cursor: pointer;"
                        onclick="window.location.href='item_details.php?id=<?php echo $row1['id'] ?>'">
                        <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                        <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                            <?php echo $row1['name']; ?></h4>
                    </div>

                    <!-- footer -->
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <?php
                        // ถ้า discount true
                        if ($row1['discount'] == 1) { ?>
                            <div class="card-text">
                                <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;"><?php echo "฿" . number_format($row1['price'], 2); ?></p>
                                <p style="margin:0;  font-size: 20px; color:red;"><?php echo "฿" . number_format($row1['discounted_price'], 2); ?></p>
                            </div>
                        <?php
                        } else { ?>
                            <div class="card-text" style="font-size: 20px; color:black;">
                                <?php echo "฿" . number_format($row1['price'], 2); ?>
                            </div>
                        <?php
                        }
                        ?>

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

            <!-- Product 2 -->
            <div class="col col-md-3 mb-4">
                <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                    <!-- body -->
                    <div class="card-body" style="cursor: pointer;"
                        onclick="window.location.href='item_details.php?id=<?php echo $row2['id'] ?>'">
                        <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                        <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                            <?php echo $row2['name']; ?></h4>
                    </div>

                    <!-- footer -->
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <?php
                        // ถ้า discount true
                        if ($row2['discount'] == 1) { ?>
                            <div class="card-text">
                                <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;"><?php echo "฿" . number_format($row2['price'], 2); ?></p>
                                <p style="margin:0;  font-size: 20px; color:red;"><?php echo "฿" . number_format($row2['discounted_price'], 2); ?></p>
                            </div>
                        <?php
                        } else { ?>
                            <div class="card-text" style="font-size: 20px; color:black;">
                                <?php echo "฿" . number_format($row2['price'], 2); ?>
                            </div>
                        <?php
                        }
                        ?>

                        <button class="btn addCart"
                            onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAddCart"
                            data-id="<?php echo $row2['id'] ?>">
                            <i style="color:red;" class="bi bi-cart3 h4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col col-md-3 mb-4">
                <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                    <!-- body -->
                    <div class="card-body" style="cursor: pointer;"
                        onclick="window.location.href='item_details.php?id=<?php echo $row3['id'] ?>'">
                        <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                        <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                            <?php echo $row3['name']; ?></h4>
                    </div>

                    <!-- footer -->
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <?php
                        // ถ้า discount true
                        if ($row3['discount'] == 1) { ?>
                            <div class="card-text">
                                <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;"><?php echo "฿" . number_format($row3['price'], 2); ?></p>
                                <p style="margin:0;  font-size: 20px; color:red;"><?php echo "฿" . number_format($row3['discounted_price'], 2); ?></p>
                            </div>
                        <?php
                        } else { ?>
                            <div class="card-text" style="font-size: 20px; color:black;">
                                <?php echo "฿" . number_format($row3['price'], 2); ?>
                            </div>
                        <?php
                        }
                        ?>

                        <button class="btn addCart"
                            onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAddCart"
                            data-id="<?php echo $row3['id'] ?>">
                            <i style="color:red;" class="bi bi-cart3 h4"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col col-md-3 mb-4">
                <div class="card h-100" style="background-color: rgba(0, 0, 0, 0.02);">
                    <!-- body -->
                    <div class="card-body" style="cursor: pointer;"
                        onclick="window.location.href='item_details.php?id=<?php echo $row4['id'] ?>'">
                        <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                        <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                            <?php echo $row4['name']; ?></h4>
                    </div>

                    <!-- footer -->
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <?php
                        // ถ้า discount true
                        if ($row4['discount'] == 1) { ?>
                            <div class="card-text">
                                <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;"><?php echo "฿" . number_format($row4['price'], 2); ?></p>
                                <p style="margin:0;  font-size: 20px; color:red;"><?php echo "฿" . number_format($row4['discounted_price'], 2); ?></p>
                            </div>
                        <?php
                        } else { ?>
                            <div class="card-text" style="font-size: 20px; color:black;">
                                <?php echo "฿" . number_format($row4['price'], 2); ?>
                            </div>
                        <?php
                        }
                        ?>

                        <button class="btn addCart"
                            onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAddCart"
                            data-id="<?php echo $row4['id'] ?>">
                            <i style="color:red;" class="bi bi-cart3 h4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- View All Products Button -->
    <div class="text-center mt-4">
        <a href="allitem.php" class="btn btn-danger">View All Products</a>
    </div>

</div>
<div class="container mt-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+1" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+2" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+3" alt="Slide 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
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