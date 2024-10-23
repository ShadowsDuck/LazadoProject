<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Lazado Gaming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar-nav {
            margin: auto;
        }

        .search-container {
            margin: 30px 0;
        }

        .search-results {
            margin-top: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
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
                        <a class="nav-link active" href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">สมัครสมาชิก</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ค้นหาสินค้า" aria-label="Search" id="searchInput">
                        <span class="input-group-text" onclick="searchProducts()">
                            <i class="bi bi-search col-md-auto"></i>
                        </span>
                    </div>
                    <a href="#" class="ms-4 mt-1"><i style="color:black;" class="bi bi-cart3 h4"></i></a>
                </div>
            </div>
        </div>
    </nav>

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
        const products = [
    { name: 'Mechanical Keyboard', image: 'https://via.placeholder.com/150', price: '1000 บาท', category: 'keyboard' },
    { name: 'Gaming Mouse', image: 'https://via.placeholder.com/150', price: '2000 บาท', category: 'mouse' },
    { name: 'Wireless Headset', image: 'https://via.placeholder.com/150', price: '1500 บาท', category: 'headset' },
    { name: 'Curved Monitor', image: 'https://via.placeholder.com/150', price: '3000 บาท', category: 'monitor' },
    { name: 'Gaming Chair', image: 'https://via.placeholder.com/150', price: '1200 บาท', category: 'chair' },
    { name: 'Gaming Desk', image: 'https://via.placeholder.com/150', price: '1800 บาท', category: 'desk' },
];
        // ฟังก์ชันค้นหาและแสดงสินค้า
        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
            const searchResults = document.getElementById('searchResults');
            const searchResultTitle = document.getElementById('searchResultTitle');
            searchResults.innerHTML = ''; // ล้างผลการค้นหาก่อนหน้า

            // เปลี่ยนหัวข้อเป็น 'ผลลัพธ์การค้นหา: <คำที่ค้นหา>'
            searchResultTitle.innerHTML = `ผลลัพธ์การค้นหา: "${searchTerm}"`;

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

        // ฟังก์ชันนี้ดึง query จาก URL และแสดงผลลัพธ์ที่ตรงกัน
        function displaySearchResults() {
            var query = getQueryParam('query');
            var resultTitle = document.getElementById('searchResultTitle');
            var searchResults = document.getElementById('searchResults');

            if (query) {
                document.getElementById('searchInput').value = query; // เติมค่าค้นหาใน input
                resultTitle.innerHTML = `ผลลัพธ์การค้นหา : "${query}"`;

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
                    searchResults.innerHTML = '<p>ไม่พบสินค้าที่ตรงกับการค้นหา</p>';
                }
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
        document.getElementById('searchInput').addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // ป้องกันการ reload หน้า
                searchProducts(); // เรียกฟังก์ชันค้นหา
            }
        });

        // เรียกฟังก์ชัน searchProducts เมื่อคลิกที่ไอคอนค้นหา
        document.querySelector('.input-group-text').addEventListener('click', function () {
            searchProducts();
        });
    </script>

</body>

</html>
