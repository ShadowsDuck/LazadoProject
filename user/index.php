<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap E-Commerce Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .navbar-nav {
            margin: auto;
        }

        .input-group-text {
            cursor: pointer;
        }

        .category-menu {
            padding-top: 0px;
        }
        .category-menu a {
            display: block;
            margin-bottom: 15px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .carousel-item img {
            width: 100%;
            height: 340px;
            object-fit: cover;
        }
        .carousel-control-prev, .carousel-control-next {
            filter: invert(100%); /* ทำให้ลูกศรสีขาวมองเห็นได้ดีขึ้น */
        }

        .container-fluid {
            padding-left: 30px; /* เพิ่ม padding-left */
            padding-right: 30px; /* เพิ่ม padding-right */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container mt-4">
            <a class="navbar-brand fw-bold fs-3" href="#">Lazado Gaming</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link active" href="#">หน้าแรก</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="../login/signup.php">สมัครสมาชิก</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ค้นหาสินค้า" aria-label="Search">
                        <span class="input-group-text">

                            <i class="bi bi-search col-md-auto"></i> 
                        </span>
                    </div>
                    <a href="#" class="ms-4 mt-1"><i style="color:black;" class="bi bi-cart3 h4"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Body -->
    <div class="container mt-5">
        <div class="row">
            <!-- Category Menu -->
            <div class="col-md-3">
                <div class="category-menu">
                    <a href="index.php">Gaming Gear<i class="bi bi-chevron-right"></i></a>
                    <a href="#">Keyboard</a>
                    <a href="#">Mouse</a>
                    <a href="#">Headset</a>
                    <a href="#">Monitor</a>
                    <a href="#">Chair</a>
                    <a href="#">Streaming </a>
                    <a href="#">Other<i class="bi bi-chevron-right"></i></a>

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
        </div>
    </div>
    

    <div class="container mt-5">
    <h2>Sale</h2>
    <h4>Today's</h4>
    <div class="d-flex justify-content-between align-items-center">

        <div class="row" id="flash-sale-products">
            <!-- Products will be inserted here via JavaScript -->
        </div>
    </div>


        <section class="container my-5">
        <h2 class="text-center mb-4">Best Selling Products</h2>
        <div class="row text-center">
            <!-- Product 1 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="images/north-coat.jpg" class="card-img-top" alt="The north coat">
                    <div class="card-body">
                        <h5 class="card-title">The north coat</h5>
                        <p class="text-danger"><del>$360</del> $260</p>
                        <p>⭐⭐⭐⭐⭐ (65)</p>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="images/gucci-bag.jpg" class="card-img-top" alt="Gucci duffle bag">
                    <div class="card-body">
                        <h5 class="card-title">Gucci duffle bag</h5>
                        <p class="text-danger"><del>$1160</del> $960</p>
                        <p>⭐⭐⭐⭐⭐ (65)</p>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="images/rgb-cpu-cooler.jpg" class="card-img-top" alt="RGB liquid CPU Cooler">
                    <div class="card-body">
                        <h5 class="card-title">RGB liquid CPU Cooler</h5>
                        <p class="text-danger"><del>$170</del> $160</p>
                        <p>⭐⭐⭐⭐⭐ (65)</p>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3">
                <div class="card">
                    <img src="images/bookshelf.jpg" class="card-img-top" alt="Small BookSelf">
                    <div class="card-body">
                        <h5 class="card-title">Small BookSelf</h5>
                        <p class="text-danger">$360</p>
                        <p>⭐⭐⭐⭐⭐ (65)</p>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- View All Products Button -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-danger">View All Products</a>
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
            <div class="category-item p-4">
                <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                <p>Keyboard</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4">
                <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                <p>Mouse</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4">
                <i class="bi bi-headset" style="font-size: 2rem;"></i>
                <p>Headset</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4">
                <i class="bi bi-display" style="font-size: 2rem;"></i>
                <p>Monitor</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4">
                <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSitzzI-H5Sdgz6VdbHhEwcubyUv0kmiO57ZA&s" style="height: 25%; width: 26%;"></i>

                <p>Chair</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="category-item p-4">
                <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                <p>Steaming</p>
            </div>
        </div>
    </div>
</section>

<!-- Best Selling Products Section -->


<div class="container my-5">
        <!-- Search and Category Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Gaming Gear</h2>
            </div>
            <div class="col-md-3">
                <!-- Search Box -->
                <input type="text" class="form-control" placeholder="Search products..." aria-label="Search1" id="gamingSearchInput">
            </div>
            <div class="col-md-3">
                <!-- Search and Dropdown section in Gaming Gear -->
                <div class="input-group">
                    <select id="categorySelect" class="form-select"  >
                        <option value="">เลือกหมวดหมู่</option>
                        <option value="keyboard">Keyboard</option>
                        <option value="mouse">Mouse</option>
                        <option value="headset">Headset</option>
                        <option value="monitor">Monitor</option>
                        <option value="chair">Chair</option>
                        <option value="desk">Desk</option>
                    </select>
                    <!-- <input type="text" class="form-control" placeholder="ค้นหาสินค้า" aria-label="Search" id="searchInput">
                    <span class="input-group-text" onclick="searchProducts()">
                        <i class="bi bi-search col-md-auto"></i>
                    </span> -->
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            <!-- Product Item -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="images/keyboard.jpg" class="card-img-top" alt="Keyboard">
                    <div class="card-body">
                        <h5 class="card-title">Mechanical Keyboard</h5>
                        <p class="text-danger"><del>$120</del> $99</p>
                        <p>⭐⭐⭐⭐⭐ (120)</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>




    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Exclusive</h5>
                    <p>Get 10% off your first order</p>
                </div>
                <div class="col-md-3">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">FAQ</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <!-- เพิ่มเนื้อหาส่วนท้ายเพิ่มเติมได้ที่นี่ -->
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Custom JS for Flash Sale -->
    <script src="script/flash_sale.js"></script>





    <script>
    // รับค่าที่กรอกในช่องค้นหา
    function searchProducts() {
        var query = document.querySelector('input[aria-label="Search1"]').value;
        if (query) {
            // Redirect to search results page with the query as a URL parameter
            window.location.href = `allitem.php?query=${encodeURIComponent(query)}`;
        }
    }

    // กด Enter ส่งค่า
    document.querySelector('input[aria-label="Search1"]').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            searchProducts();
        }
        if (condition) {
            
        } else {
            
        }
    });


    //ช่องค้นหาข้างล่างสุดดด
    function searchProducts2() {
        var query = document.querySelector('input[aria-label="Search"]').value;
        if (query) {
            // Redirect to search results page with the query as a URL parameter
            window.location.href = `allitem.php?query=${encodeURIComponent(query)}`;
        }
    }

    // กด Enter ส่งค่า
    document.querySelector('input[aria-label="Search"]').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            searchProducts2();
        }
    });



</script>

<script>
    const gamingProducts = [
        { name: 'Mechanical Keyboard', category: 'keyboard', price: '$99', image: 'keyboard_image_url' },
        { name: 'Gaming Mouse', category: 'mouse', price: '$45', image: 'mouse_image_url' },
        { name: 'Wireless Headset', category: 'headset', price: '$70', image: 'headset_image_url' },
        { name: 'Curved Monitor', category: 'monitor', price: '$350', image: 'monitor_image_url' }
    ];

    // ฟังก์ชันค้นหาสินค้าจากช่องค้นหาและหมวดหมู่
    function searchGamingProducts() {
        const searchTerm = document.getElementById('gamingSearchInput').value.trim().toLowerCase();
        const selectedCategory = document.getElementById('gamingCategorySelect').value;
        const searchResults = document.getElementById('gamingProductResults'); // แก้ไขให้ตรงกับส่วนที่แสดงผลสินค้า

        searchResults.innerHTML = ''; // ล้างผลลัพธ์เก่า

        const filteredProducts = gamingProducts.filter(product => {
            const matchesSearch = product.name.toLowerCase().includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || product.category === selectedCategory;
            return matchesSearch && matchesCategory;
        });

        if (filteredProducts.length === 0) {
            searchResults.innerHTML = '<p>No products found</p>';
        } else {
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
        }
    }

    // เรียกใช้ฟังก์ชัน searchGamingProducts เมื่อมีการพิมพ์ในช่องค้นหา หรือเลือกหมวดหมู่ใน Dropdown

    document.getElementById('gamingSearchInput').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // ป้องกันการ reload หน้า
        searchProducts2(); // เรียกฟังก์ชันค้นหา
    }
    });

// เรียกฟังก์ชัน searchProducts เมื่อคลิกที่ไอคอนค้นหาของ gamingSearchInput
    document.querySelector('.gaming-search-btn').addEventListener('click', function () {
        searchProducts2();
    });
    </script>

</body>

</html>