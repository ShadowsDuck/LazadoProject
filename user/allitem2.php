<?php include('partials/header.php'); ?>
<style>
.slt.active {
    background-color: #007bff; /* สีพื้นหลังเมื่อ active */
    color: white; /* สีของข้อความและไอคอนเมื่อ active */
    border-radius: 8px; /* เพิ่มมุมโค้ง */
    padding: 10px; /* ขนาด padding */
    transition: all 0.3s ease-in-out; /* เพิ่มการเปลี่ยนแปลงที่นุ่มนวล */
}

.slt.active i {
    color: white; /* สีของไอคอนเมื่อ active */ 
}

.slt.active p {
    color: white; /* สีของข้อความเมื่อ active */
}
</style>


<!-- Icon หมวดหมู่-->
<section class="container">
    <div class="row text-center">
        <div class="col-md-2">
            <div class="category-item p-4 m-0" onclick="selectCategory(this, 'keyboard')">
                <div class="slt p-0">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4 m-0" onclick="selectCategory(this, 'mouse')">
            <div class="slt p-0">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4 m-0" onclick="selectCategory(this, 'headset')">
            <div class="slt p-0">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4 m-0" onclick="selectCategory(this, 'monitor')">
            <div class="slt p-0">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4 m-0" onclick="selectCategory(this, 'chair')">
            <div class="slt p-0">
                <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://www.svgrepo.com/show/281964/desk-chair-chair.svg" style="height: 2.5rem; width: 2.5rem; color:blue;"></i>
                <p>Chair</p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4 m-0" onclick="selectCategory(this, 'streaming')">
            <div class="slt p-0">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Streaming</p>
                </div>
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
