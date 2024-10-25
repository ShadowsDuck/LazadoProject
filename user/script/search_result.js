
// ตัวอย่างข้อมูลสินค้า
const products = [
    { name: 'Mechanical Keyboard33', image: 'https://via.placeholder.com/150', price: '1000 บาท', category: 'keyboard' },
    { name: 'Gaming Mouse', image: 'https://via.placeholder.com/150', price: '2000 บาท', category: 'mouse' },
    { name: 'Wireless Headset', image: 'https://via.placeholder.com/150', price: '1500 บาท', category: 'headset' },
    { name: 'Curved Monitor', image: 'https://via.placeholder.com/150', price: '3000 บาท', category: 'monitor' },
    { name: 'Gaming Chair', image: 'https://via.placeholder.com/150', price: '1200 บาท', category: 'chair' },
    { name: 'Gaming Desk', image: 'https://via.placeholder.com/150', price: '1800 บาท', category: 'desk' },
    { name: 'Mechanical2 Keyboard364', image: 'https://via.placeholder.com/150', price: '1000 บาท', category: 'keyboard' },
    { name: 'Gaming Mouse2', image: 'https://via.placeholder.com/150', price: '2000 บาท', category: 'mouse' },
    { name: 'Wireless Headset2', image: 'https://via.placeholder.com/150', price: '1500 บาท', category: 'headset' },
    { name: 'Curved Monitor2', image: 'https://via.placeholder.com/150', price: '3000 บาท', category: 'monitor' },
    { name: 'Gaming Chair2', image: 'https://via.placeholder.com/150', price: '1200 บาท', category: 'chair' },
    { name: 'Gaming Desk2', image: 'https://via.placeholder.com/150', price: '1800 บาท', category: 'desk' },
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


function selectCategory(element, category) {
    // ลบคลาส active ออกจากทุกหมวดหมู่
    const items = document.querySelectorAll('.category-item');

    
    
    items.forEach(item => item.classList.remove('active'));

    // เพิ่มคลาส active ให้กับหมวดหมู่ที่ถูกคลิก
    element.classList.add('active');

    console.log('Active class added:', element.classList.contains('active'));
    // เรียกใช้ฟังก์ชันการค้นหาหมวดหมู่
    displaySearchResults(category);

    
    
}


//ค้นหาผ่านไอคอนcategory ของ allitem.php
// function searchByCategory(category) {
//     window.location.href = `allitem.php?category=${category}`;
// }
