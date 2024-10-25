<?php include('partials/header.php');
$currentPage = basename($_SERVER['REQUEST_URI']);
$currentCategory = isset($_GET['category']) ? $_GET['category'] : null; // Get the category from the URL
require('../connect.php');
?>

<style>
    .category-item {
        cursor: pointer;
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
            <div class="category-item m-4 <?php echo ($currentCategory === 'keyboard') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=keyboard'">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'mouse') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=mouse'">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'headset') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=headset'">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'monitor') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=monitor'">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'chair') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=chair'">
                <i class="bi bi-chair" style="font-size: 2rem;"><img
                        src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg"
                        style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'streaming') ? 'active' : ''; ?>"
                onclick="window.location.href='allitem.php?c=streaming'">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Streaming</p>
            </div>
        </div>
    </div>
    <div class="row search-container">
        <h4 id="searchResultTitle">ผลลัพธ์การค้นหา :</h4>
        <div class="container my-5">
            <div class="row">
                <?php
                $c = '';
                $sql = "SELECT * FROM products";
                if (isset($_GET["c"])) {
                    $c = $_GET['c'];
                }

                if ($c == 'keyboard') {
                    $sql = 'SELECT * FROM products WHERE category=1';
                }elseif ($c == 'mouse') {
                    $sql = 'SELECT * FROM products WHERE category=2';
                }elseif ($c == 'headset') {
                    $sql = 'SELECT * FROM products WHERE category=3';
                }elseif ($c == 'monitor') {
                    $sql = 'SELECT * FROM products WHERE category=4';
                }elseif ($c == 'chair') {
                    $sql = 'SELECT * FROM products WHERE category=5';
                }elseif ($c == 'streaming') {
                    $sql = 'SELECT * FROM products WHERE category=6';
                }else {
                    $sql = "SELECT * FROM products";
                }


                $result = mysqli_query($conn, $sql);

                // Loop ข้อมูลแต่ละแถวในฐานข้อมูล
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-3 mb-4">
                            <div class="card h-100">
                                <img src="https://placehold.co/200" class="card-img-top" alt="Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                    <p class="card-text"><?php echo $row['price']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No records found.";
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