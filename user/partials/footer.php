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
        //ช่องค้นหาข้างบนสุดบน Navbar
        function searchProducts2() {
            var query = document.querySelector('input[aria-label="Search"]').value;
            if (query) {
                // Redirect to search results page with the query as a URL parameter
                window.location.href = `allitem.php?query=${encodeURIComponent(query)}`;
            }
        }

        // กด Enter ส่งค่า
        document.querySelector('input[aria-label="Search"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchProducts2();
            }
        });
        // เรียกฟังก์ชัน searchProducts2 เมื่อคลิกที่ไอคอนค้นหาของ Navbar
        document.querySelector('.search-icon-class').addEventListener('click', function() {
            searchProducts2();
        });


        //ค้นหาผ่านไอคอนcategory
        function searchByCategory(category) {
            window.location.href = `allitem.php?category=${category}`;
        }
    </script>

    <script>
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

        document.getElementById('gamingSearchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // ป้องกันการ reload หน้า
                searchProducts2(); // เรียกฟังก์ชันค้นหา
            }
        });

        // เรียกฟังก์ชัน searchProducts เมื่อคลิกที่ไอคอนค้นหาของ gamingSearchInput
        document.querySelector('.gaming-search-btn').addEventListener('click', function() {
            searchProducts2();
        });
    </script>

</body>

</html>