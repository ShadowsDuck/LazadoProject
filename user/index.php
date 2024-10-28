<?php include('partials/header.php'); ?>

<style>
    .swal2-popup .swal2-styled:focus {
        box-shadow: none !important;
    }
</style>

<!-- Body -->
<div class="container mt-5">
    <div class="row">
        <!-- Category Menu -->
        <div class="col-md-3">
            <div class="category-menu">
                <a href="allitem.php">เกมมิ่งเกียร์<i class="bi bi-chevron-right"></i></a>
                <a href="allitem.php?c=keyboard">คีย์บอร์ด</a>
                <a href="allitem.php?c=mouse">เมาส์</a>
                <a href="allitem.php?c=headset">หูฟัง</a>
                <a href="allitem.php?c=monitor">จอมอนิเตอร์</a>
                <a href="allitem.php?c=chair">เก้าอี้</a>
                <a href="allitem.php?c=streaming">สตรีมมิ่ง</a>
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
                        <img src="https://assets2.razerzone.com/images/og-image/Razer-Products-OGimage-1200x630.jpg" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://www.ceogallery.com.my/image/ceogallery/image/data/gaming%20gear%20banner.jpg" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://lh7-us.googleusercontent.com/docsz/AD_4nXfGK3Pt7cCXtcK0BLruwQb5CGffXrTe__wi6JVkiL_-39Rw-pxC8-mQNzXFaHfvf77PEH41gBUlCX_LJLUNekCraIlccZe7T9ODq61JuQKZ4-brTFMznPGAfSEza6W1J-P5dsIqCwMffgDbgEN1XGVtun9f?key=ki8BMy9Fx1MSttNl4rVBVw" alt="Slide 3">
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
    <h2 class="text-center mb-4">โปรโมชั่นประจำเดือนนี้</h2>
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
                                    $imageURL = !empty($row1['file_name']) ? '../uploads/' . $row1['file_name'] : 'https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg';
                                    ?>
                                    <img src="<?php echo $imageURL ?>" class="card-img-top mb-3" alt="Image" width="200px" loading="lazy">
                                    <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                                        <?php echo $row1['name']; ?></h4>
                                </div>

                                <!-- footer -->
                                <div class="card-footer d-flex justify-content-between align-items-center" style="background-color:white; border-top:none;">
                                    <?php
                                    if ($row1['discount'] == 1) { ?>
                                        <div class="card-text">
                                            <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;">
                                                <?php echo "฿" . number_format($row1['price'], 2); ?>
                                            </p>
                                            <p style="margin:0; font-size: 20px; color:red;">
                                                <?php echo "฿" . number_format($row1['discounted_price'], 2); ?>
                                            </p>
                                        </div>

                                    <?php
                                    } else { ?>
                                        <div class="card-text" style="font-size: 20px; color:black;">
                                            <?php echo "฿" . number_format($row1['price'], 2); ?>
                                        </div>
                                    <?php
                                    }

                                    if ($row1['available'] == 1) { ?>
                                        <button class="btn addCart"
                                            onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                                            data-id="<?php echo $row1['id'] ?>">
                                            <i style="color:red;" class="bi bi-cart3 h4"></i>
                                        </button>
                                    <?php
                                    } else { ?>
                                        <p style="display:inline; color:red; font-weight:bold; font-size: medium; margin:0; margin-top:11.5px; margin-bottom:11.5px;">
                                            สินค้าหมด
                                        </p>
                                    <?php
                                    }
                                    ?>
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
            $result = mysqli_query($conn, "SELECT * FROM products WHERE id IN (62, 4, 5, 7)");

            // Loop through each product
            while ($row = mysqli_fetch_assoc($result)) {
                $imageURL = !empty($row['file_name']) ? '../uploads/' . $row['file_name'] : 'https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg';
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

                            <?php
                            if ($row['discount'] == 1) { ?>
                                <div class="card-text">
                                    <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;">
                                        <?php echo "฿" . number_format($row['price'], 2); ?>
                                    </p>
                                    <p style="margin:0; font-size: 20px; color:red;">
                                        <?php echo "฿" . number_format($row['discounted_price'], 2); ?>
                                    </p>
                                </div>

                            <?php
                            } else { ?>
                                <div class="card-text" style="font-size: 20px; color:black;">
                                    <?php echo "฿" . number_format($row['price'], 2); ?>
                                </div>
                            <?php
                            }

                            if ($row['available'] == 1) { ?>
                                <button class="btn addCart"
                                    onclick="<?php $_SESSION['currentpage'] = basename($_SERVER['REQUEST_URI']); ?>"
                                    data-id="<?php echo $row['id'] ?>">
                                    <i style="color:red;" class="bi bi-cart3 h4"></i>
                                </button>
                            <?php
                            } else { ?>
                                <p style="display:inline; color:red; font-weight:bold; font-size: medium; margin:0; margin-top:11.5px; margin-bottom:11.5px;">
                                    สินค้าหมด
                                </p>
                            <?php
                            }
                            ?>
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
        <a href="allitem.php" class="btn btn-danger">ดูสินค้าทั้งหมด</a>
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
                <img src="https://img.freepik.com/premium-photo/top-view-gaming-gear_1106939-204805.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img.freepik.com/premium-photo/cyber-sportsman-cyber-defense-cyberprep-online-hacker-hacker-hacking-online-cyber_569725-17137.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img.freepik.com/premium-photo/gamer-background-gaming-background-gamer-room-gaming-room-gaming-wallpaper_569725-7347.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bottomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">ก่อนหน้า</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bottomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">ถัดไป</span>
        </button>
    </div>
</div>

<!-- Browse By Category Section -->
<section class="container my-5">
    <h2 class="text-center mb-4">จัดเรียงตามประเภท</h2>
    <div class="row text-center">
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=keyboard'" style="cursor: pointer;">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>คีย์บอร์ด</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=mouse'" style="cursor: pointer;">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>เมาส์</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=headset'" style="cursor: pointer;">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>หูฟัง</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=monitor'" style="cursor: pointer;">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>จอมอนิเตอร์</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=chair'" style="cursor: pointer;">
                <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg" style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>เก้าอี้</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="window.location.href='allitem.php?c=streaming'" style="cursor: pointer;">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>สตรีมมิ่ง</p>
            </div>
        </div>
    </div>
</section>

<?php
$orderSuccess = $_SESSION['orderSuccess'] ?? null;
unset($_SESSION['orderSuccess']);
?>
<!-- Modal ชำระเงินเสร็จสิ้น -->
<div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="paymentSuccessModalLabel">ชำระเงินเสร็จสิ้น</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- ไอคอนติ๊กถูก -->
                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
                <p class="mt-3">ขอบคุณที่ชำระเงิน การสั่งซื้อของคุณเสร็จสมบูรณ์แล้ว!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">ตกลง</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ชำระเงินไม่สำเร็จ -->
<div class="modal fade" id="paymentFailedModal" tabindex="-1" aria-labelledby="paymentFailedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="paymentFailedModalLabel">ชำระเงินไม่สำเร็จ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- ไอคอน X -->
                <i class="bi bi-x-circle-fill" style="font-size: 3rem; color: red;"></i>
                <p class="mt-3">เกิดข้อผิดพลาดในการชำระเงิน กรุณาลองใหม่อีกครั้ง</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">ตกลง</button>
            </div>
        </div>
    </div>
</div>

<script src="script/flash_sale.js"></script>
<script src="script/search.js"></script>
<script src="script/search_result.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const orderSuccess = "<?php echo $orderSuccess; ?>"; // รับค่าจาก PHP

        if (orderSuccess == '1') {
            Swal.fire({
                title: "สั่งซื้อเสร็จสิ้น!",
                text: "ขอบคุณที่สั่งซื้อ การสั่งซื้อของคุณเสร็จสมบูรณ์แล้ว!",
                icon: "success",
                confirmButtonText: "ตกลง",
                confirmButtonColor: "#dc3545"
            });
        } else if (orderSuccess == '0') {
            Swal.fire({
                title: "สั่งซื้อไม่สำเร็จ!",
                text: "เกิดข้อผิดพลาดในการสั่งซื้อ กรุณาลองใหม่อีกครั้ง",
                icon: "error",
                confirmButtonText: "ตกลง",
                confirmButtonColor: "#dc3545"
            });
        }
    });

    // ดึงปุ่มลบและเรียก SweetAlert เมื่อกดปุ่มลบ
    document.querySelectorAll('.addCart').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // ป้องกันการรีเฟรชหน้า

            // ดึง id ของผู้ดูแลจากปุ่มที่คลิก
            const productId = button.getAttribute('data-id');

            // แสดง SweetAlert สำหรับยืนยันการลบ
            Swal.fire({
                title: "เพิ่มสินค้า",
                text: "คุณต้องการเพิ่มสินค้าไปยังตะกร้า?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "เพิ่มสินค้า",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `add_to_cart.php?id=${productId}`;
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        fetch('session_message.php')
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: data.message,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                }
            })
            .catch(error => console.error('เกิดข้อผิดพลาด!:', error));
    });
</script>

<?php include('partials/footer.php'); ?>