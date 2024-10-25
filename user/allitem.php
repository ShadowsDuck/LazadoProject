<?php include('partials/header.php');
$currentPage = basename($_SERVER['REQUEST_URI']);
$currentCategory = isset($_GET['category']) ? $_GET['category'] : null; // Get the category from the URL
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
            <div class="category-item m-4 <?php echo ($currentCategory === 'keyboard') ? 'active' : ''; ?>" onclick="selectCategory(this, 'keyboard')">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'mouse') ? 'active' : ''; ?>" onclick="selectCategory(this, 'mouse')">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'headset') ? 'active' : ''; ?>" onclick="selectCategory(this, 'headset')">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'monitor') ? 'active' : ''; ?>" onclick="selectCategory(this, 'monitor')">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'chair') ? 'active' : ''; ?>" onclick="selectCategory(this, 'chair')">
                <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg" style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2 py-4">
            <div class="category-item m-4 <?php echo ($currentCategory === 'streaming') ? 'active' : ''; ?>" onclick="selectCategory(this, 'streaming')">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Streaming</p>
            </div>
        </div>
    </div>
    <div class="row search-container">
        <h4 id="searchResultTitle">ผลลัพธ์การค้นหา :</h4>
        <div class="row" id="searchResults">
            <!-- สินค้าจะแสดงที่นี่ -->
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="http://localhost/LazadoProject/user/script/search_result.js"></script> <!--- Script serach_result.js--->
<script src="http://localhost/LazadoProject/user/script/search.js"></script>

<?php include('partials/footer.php'); ?>