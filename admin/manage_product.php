<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <h1>จัดการสินค้า</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
        data-bs-target="#addProductModal">
        เพิ่มสินค้า
    </button>

    <!-- Modal for Add Product -->
    <div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">เพิ่มสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="order_id">

                        <!-- Product Name field -->
                        <div class="form-group mb-3">
                            <label for="product_name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" placeholder="กรุณาใส่ชื่อสินค้า" name="product_name">
                        </div>

                        <!-- Description field -->
                        <div class="form-group mb-3">
                            <label for="description">รายละเอียด</label>
                            <textarea class="form-control" name="description" placeholder="กรุณาใส่รายละเอียดสินค้า" rows="3"></textarea>
                        </div>

                        <!-- Price field -->
                        <div class="form-group mb-3">
                            <label for="price_product">ราคา</label>
                            <input type="number" class="form-control" placeholder="กรุณาใส่ราคา" name="price_product">
                        </div>

                        <!-- Product Image field -->
                        <div class="form-group mb-3">
                            <label for="product_image" class="form-label">รูปสินค้า</label>
                            <input class="form-control" type="file" name="product_image">
                        </div>

                        <!-- Product Category field -->
                        <div class="form-group mb-3">
                            <label for="product_category">หมวดหมู่สินค้า</label>
                            <select class="form-select" aria-label="product_category">
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
                        <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Browse By Category Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">หมวดหมู่สินค้า</h2>
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
                    <p>Streaming</p>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Search Results Section -->
<div class="container">
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

<script>
    // ตัวอย่างข้อมูลสินค้า
    const products = [{
            name: 'Mechanical Keyboard',
            image: 'https://via.placeholder.com/150',
            price: '1000 บาท',
            category: 'keyboard'
        },
        {
            name: 'Gaming Mouse',
            image: 'https://via.placeholder.com/150',
            price: '2000 บาท',
            category: 'mouse'
        },
        {
            name: 'Wireless Headset',
            image: 'https://via.placeholder.com/150',
            price: '1500 บาท',
            category: 'headset'
        },
        {
            name: 'Curved Monitor',
            image: 'https://via.placeholder.com/150',
            price: '3000 บาท',
            category: 'monitor'
        },
        {
            name: 'Gaming Chair',
            image: 'https://via.placeholder.com/150',
            price: '1200 บาท',
            category: 'chair'
        },
        {
            name: 'Gaming Desk',
            image: 'https://via.placeholder.com/150',
            price: '1800 บาท',
            category: 'desk'
        },
    ];

    // ฟังก์ชันค้นหาและแสดงสินค้า จากการใช้ Navbar หน้านี้
    function searchProducts() {
        const searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
        const searchResults = document.getElementById('searchResults');
        const searchResultTitle = document.getElementById('searchResultTitle');
        searchResults.innerHTML = ''; // ล้างผลการค้นหาก่อนหน้า

        // เปลี่ยนหัวข้อเป็น 'ผลลัพธ์การค้นหา: <คำที่ค้นหา>'
        searchResultTitle.innerHTML = `ผลลัพธ์การค้นหา : "${searchTerm}"`;

        const filteredProducts = products.filter(product => product.name.toLowerCase().includes(searchTerm));

        if (filteredProducts.length === 0) {
            searchResults.innerHTML = '<p>ไม่พบสินค้าที่คุณค้นหา</p>';
        } else {
            filteredProducts.forEach(product => {
                const productCard = `
                        <div class="col-md-3">
                            <div class="product-card">
                                <img src="${product.image}" alt="${product.name}">
                                <h5>${product.name}</h5>
                                <p>${product.price}</p>
                            </div>
                        </div>
                    `;
                searchResults.innerHTML += productCard;
            });
        }
    }

    //ค้นหาผ่านไอคอนcategory
    function searchByCategory(category) {
        window.location.href = `manage_product.php?category=${category}`;
    }

    function displaySearchResults() {
        var query = getQueryParam('query'); // ดึงคำค้นจาก URL
        var category = getQueryParam('category'); // ดึงหมวดหมู่จาก URL
        var resultTitle = document.getElementById('searchResultTitle');
        var searchResults = document.getElementById('searchResults');

        if (query) { // ค้นหาจากชื่อ
            resultTitle.innerHTML = `ผลลัพธ์การค้นหา: "${query}"`;

            const filteredProducts = products.filter(product => product.name.toLowerCase().includes(query.toLowerCase()));

            // แสดงสินค้า
            searchResults.innerHTML = '';
            if (filteredProducts.length > 0) {
                filteredProducts.forEach(product => {
                    searchResults.innerHTML += `
                        <div class="col-md-3">
                            <div class="product-card">
                                <img src="${product.image}" alt="${product.name}">
                                <h5>${product.name}</h5>
                                <p>${product.price}</p>
                            </div>
                        </div>
                    `;
                });
            } else {
                searchResults.innerHTML = '<p>ไม่พบสินค้าที่คุณค้นหา</p>';
            }

        } else if (category) { // ค้นหาจากหมวดหมู่
            resultTitle.innerHTML = `ผลลัพธ์การค้นหาหมวดหมู่: ${category}`;

            const filteredProducts = products.filter(product => product.category.toLowerCase() === category.toLowerCase());

            // แสดงสินค้า
            searchResults.innerHTML = '';
            if (filteredProducts.length > 0) {
                filteredProducts.forEach(product => {
                    searchResults.innerHTML += `
                        <div class="col-md-3">
                            <div class="product-card">
                                <img src="${product.image}" alt="${product.name}">
                                <h5>${product.name}</h5>
                                <p>${product.price}</p>
                            </div>
                        </div>
                    `;
                });
            } else {
                searchResults.innerHTML = '<p>ไม่พบสินค้าที่ตรงกับหมวดหมู่ที่คุณเลือก</p>';
            }

        } else {
            resultTitle.innerHTML = 'ไม่พบผลลัพธ์';
            searchResults.innerHTML = '<p>กรุณาค้นหาสินค้าหรือเลือกหมวดหมู่</p>';
        }
    }

    // ฟังก์ชันช่วยดึง query param จาก URL
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // เรียกใช้การแสดงผลลัพธ์ตอนโหลดหน้า
    window.onload = displaySearchResults;

    // เรียกฟังก์ชัน searchProducts เมื่อกด Enter ใน input search
    document.getElementById('searchInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // ป้องกันการ reload หน้า
            searchProducts(); // เรียกฟังก์ชันค้นหา
        }
    });

    // เรียกฟังก์ชัน searchProducts เมื่อคลิกที่ไอคอนค้นหา
    document.querySelector('.input-group-text').addEventListener('click', function() {
        searchProducts();
    });
</script>

<?php include('partials/footer.php'); ?>