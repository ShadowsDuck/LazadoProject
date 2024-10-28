<?php include('partials/header.php');
$currentPage = basename($_SERVER['REQUEST_URI']);
$currentCategory = isset($_GET['category']) ? $_GET['category'] : null; // Get the category from the URL
require('../connect.php');
?>

<style>
    .category-item {
        cursor: pointer;
        border: 2px solid transparent;
        /* ขอบโปร่งใสที่ช่วยให้ขนาดคงที่ */
        border-radius: 8px;
    }

    .category-item.active {
        border: 2px solid white;
        /* กรอบเมื่อถูกเลือก */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* background-color: red; */
    }
</style>


<!-- Icon หมวดหมู่-->
<section class="container">
    <div class="row text-center">
        <h2 class="text-center mt-5">จัดเรียงตามประเภท</h2>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php' || strpos($currentPage, 'allitem.php?keyword=') === 0) ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php'">
                <i class="bi bi-grid" style="font-size: 2rem;"></i>
                <p>ทั้งหมด</p>
            </div>
        </div>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=keyboard') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=keyboard'">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>คีย์บอร์ด</p>
            </div>
        </div>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=mouse') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=mouse'">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>เมาส์</p>
            </div>
        </div>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=headset') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=headset'">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>หูฟัง</p>
            </div>
        </div>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=monitor') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=monitor'">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>จอมอนิเตอร์</p>
            </div>
        </div>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=chair') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=chair'">
                <i class="bi bi-chair" style="font-size: 2rem;"><img
                        src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg"
                        style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>เก้าอี้</p>
            </div>
        </div>
        <div class="col">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=streaming') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=streaming'">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>สตรีมมิ่ง</p>
            </div>
        </div>
    </div>
    <div class="row search-container">
        <?php
        $c = '';
        $keyword = '';
        $sql = "SELECT * FROM products ORDER BY available DESC, created_at DESC";

        if (isset($_GET["c"])) {
            $c = $_GET['c'];
        }
        if (isset($_GET["keyword"])) {
            $keyword = $_GET['keyword'];
            $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' ORDER BY available DESC, created_at DESC";
        }

        if ($c == 'keyboard') {
            $sql = "SELECT * FROM products WHERE category=1 ORDER BY available DESC, created_at DESC";
        } elseif ($c == 'mouse') {
            $sql = "SELECT * FROM products WHERE category=2 ORDER BY available DESC, created_at DESC";
        } elseif ($c == 'headset') {
            $sql = "SELECT * FROM products WHERE category=3 ORDER BY available DESC, created_at DESC";
        } elseif ($c == 'monitor') {
            $sql = "SELECT * FROM products WHERE category=4 ORDER BY available DESC, created_at DESC";
        } elseif ($c == 'chair') {
            $sql = "SELECT * FROM products WHERE category=5 ORDER BY available DESC, created_at DESC";
        } elseif ($c == 'streaming') {
            $sql = "SELECT * FROM products WHERE category=6 ORDER BY available DESC, created_at DESC";
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
                                <div class="card-body" style="cursor: pointer;"
                                    onclick="window.location.href='item_details.php?id=<?php echo $row['id'] ?>'">
                                    <?php
                                    $imageURL = !empty($row['file_name']) ? '../uploads/' . $row['file_name'] : 'https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg';
                                    ?>
                                    <img src="<?php echo $imageURL ?>" class="card-img-top mb-3" alt="Image" width="200px" loading="lazy">
                                    <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                                        <?php echo $row['name']; ?></h4>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center" style="background-color:white; border-top:none;">
                                    <?php
                                    // ถ้า discount true
                                    if ($row['discount'] == 1) { ?>
                                        <div class="card-text">
                                            <p style="text-decoration: line-through; margin:0; font-size: 12px; color:black;"><?php echo "฿" . number_format($row['price'], 2); ?></p>
                                            <p style="margin:0; font-size: 17px; color:red;"><?php echo "฿" . number_format($row['discounted_price'], 2); ?></p>
                                        </div>
                                    <?php
                                    } else { ?>
                                        <div class="card-text" style="font-size: 17px; color:black;">
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
                                        <p style="display:inline; color:red; font-weight:bold; font-size: small; margin:0; margin-top:11.5px; margin-bottom:11.5px;">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // ดึงปุ่มลบหลัก และเมื่อกดจะเปิด Modal พร้อมส่งค่า id ไปยังปุ่มลบใน Modal
    document.querySelectorAll('.addCart').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // ดึง id ของผู้ดูแลจากปุ่มที่คลิก
            const productId = button.getAttribute('data-id');

            // อัปเดตลิงก์ของปุ่มลบใน Modal
            const confirmDeleteBtn = document.getElementById('confirmAdd');
            confirmDeleteBtn.href = `add_to_cart.php?id=${productId}`;
        });
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
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
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

<?php
include('partials/footer.php');
$conn->close();
?>