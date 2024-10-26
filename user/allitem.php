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
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=keyboard') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=keyboard'">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=mouse') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=mouse'">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=headset') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=headset'">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=monitor') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=monitor'">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=chair') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=chair'">
                <i class="bi bi-chair" style="font-size: 2rem;"><img
                        src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg"
                        style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentPage === 'allitem.php?c=streaming') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=streaming'">
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
                                <div class="card-body" style="cursor: pointer;"
                                    onclick="window.location.href='item_details.php?id=<?php echo $row['id'] ?>'">
                                    <img src="https://placehold.co/200" class="card-img-top mb-3" alt="Image">
                                    <h4 class="card-title" style=" font-weight:600; font-size:0.8rem;">
                                        <?php echo $row['name']; ?></h4>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <div class="card-text text-danger" style="font-weight: bold; font-size: 18px;">
                                        <?php echo "฿" . number_format($row['price'], 2); ?>
                                    </div>
                                    <button class="btn"><i style="color:red;" class="bi bi-cart3 h4"></i></button>
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
<!-- <script src="http://localhost/LazadoProject/user/script/search_result.js"></script>
<script src="http://localhost/LazadoProject/user/script/search.js"></script> -->

<?php include('partials/footer.php'); ?>