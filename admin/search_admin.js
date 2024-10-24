//ช่องค้นหาข้างบนสุดบน Navbar
function searchProducts2() {
    var query = document.querySelector('input[aria-label="Search"]').value;
    if (query) {
        // Redirect to search results page with the query as a URL parameter
        window.location.href = `manage_product.php?query=${encodeURIComponent(query)}`;
    }
}

// กด Enter ส่งค่า
document.querySelector('input[aria-label="Search"]').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        searchProducts2();
    }
});
// เรียกฟังก์ชัน searchProducts2 เมื่อคลิกที่ไอคอนค้นหาของ Navbar
document.querySelector('.search-icon-class').addEventListener('click', function () {
    searchProducts2();
});


//ค้นหาผ่านไอคอนcategory
function searchByCategory(category) {
    window.location.href = `manage_product.php?category=${category}`;
}

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
