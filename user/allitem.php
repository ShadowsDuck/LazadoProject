<?php include('partials/header.php'); ?>
<style>

</style>
<!-- Icon หมวดหมู่-->
<section class="container">
<div class="row text-center">
        <div class="col-md-2">
            <div class="category-item p-4" onclick="searchByCategory('keyboard')">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="searchByCategory('mouse')">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="searchByCategory('headset')">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="searchByCategory('monitor')">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="searchByCategory('chair')">
                <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSitzzI-H5Sdgz6VdbHhEwcubyUv0kmiO57ZA&s" style="height: 25%; width: 26%;"></i>
                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4" onclick="searchByCategory('streaming')">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Steaming</p>
            </div>
        </div>
    </div>
    </section>

    
    <!-- Search Results Section -->
    <div class="container mt-1">
        <div class="row search-container">
            <h4 id="searchResultTitle">ผลลัพธ์การค้นหา :</h4>
            <div class="row" id="searchResults">
                <!-- สินค้าจะแสดงที่นี่ -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="script/search_result.js"></script> <!--- Script serach_result.js--->
    <script src="http://localhost/LazadoProject/user/script/search.js"></script>
<?php include('partials/footer.php'); ?>
