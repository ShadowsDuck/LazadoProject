// ข้อมูลสินค้า Flash Sale
const products = [
    {
        name: 'HAVIT HV-G92 Gamepad',
        price: 120,
        originalPrice: 160,
        discount: 40,
        image: 'path_to_image/havit_gamepad.jpg'
    },
    {
        name: 'AK-900 Wired Keyboard',
        price: 960,
        originalPrice: 1160,
        discount: 35,
        image: 'path_to_image/keyboard.jpg'
    },
    {
        name: 'IPS LCD Gaming Monitor',
        price: 370,
        originalPrice: 400,
        discount: 30,
        image: 'path_to_image/monitor.jpg'
    },
    {
        name: 'S-Series Comfort Chair',
        price: 375,
        originalPrice: 400,
        discount: 25,
        image: 'path_to_image/chair.jpg'
    },
    {
        name: 'IPS LCD Gaming Monitor',
        price: 370,
        originalPrice: 400,
        discount: 30,
        image: 'path_to_image/monitor.jpg'
    },
    {
        name: 'S-Series Comfort Chair',
        price: 375,
        originalPrice: 400,
        discount: 25,
        image: 'path_to_image/chair.jpg'
    },
    {
        name: 'IPS LCD Gaming Monitor',
        price: 370,
        originalPrice: 400,
        discount: 30,
        image: 'path_to_image/monitor.jpg'
    },
    {
        name: 'S-Series Comfort Chair',
        price: 375,
        originalPrice: 400,
        discount: 25,
        image: 'path_to_image/chair.jpg'
    }
];
function createProductCard(product) {
    return `
        <div class="col-md-3">
            <div class="card mb-4">
                <img src="${product.image}" class="card-img-top" alt="${product.name}">
                <div class="card-body">
                    <h5 class="card-title">${product.name}</h5>
                    <p class="card-text">
                        <small class="text-muted"><del>$${product.originalPrice}</del></small><br>
                        <strong>$${product.price}</strong> (-${product.discount}%)
                    </p>
                </div>
            </div>
        </div>
    `;
}

// function displayProducts() {
//     const carouselInner = document.getElementById('carouselInner');
//     let itemsPerSlide = 4; // แสดง 4 ชิ้นต่อแถว
//     let totalItems = products.length;
//     let carouselItemsHTML = '';

//     // แบ่งสินค้าออกเป็นกลุ่ม ๆ ตามจำนวนสินค้าที่จะแสดงในแต่ละแถว
//     for (let i = 0; i < totalItems; i += itemsPerSlide) {
//         let activeClass = i === 0 ? 'active' : ''; // ทำให้แถวแรกเป็น active
//         carouselItemsHTML += `<div class="carousel-item ${activeClass}"><div class="row">`;

//         // เพิ่มสินค้าในแถวนี้
//         for (let j = i; j < i + itemsPerSlide && j < totalItems; j++) {
//             carouselItemsHTML += createProductCard(products[j]);
//         }

//         carouselItemsHTML += '</div></div>';
//     }

//     // เพิ่มสินค้าใน carousel
//     carouselInner.innerHTML = carouselItemsHTML;
// }

// // เรียกใช้ฟังก์ชันเมื่อเริ่มต้น
// displayProducts();

// ฟังก์ชันเพื่อแสดงสินค้าใน Flash Sale
function renderFlashSale() {
    const flashSaleContainer = document.getElementById('flash-sale-products');
    flashSaleContainer.innerHTML = ''; // ล้างเนื้อหาเดิม

    products.forEach(product => {
        const productCard = `
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="${product.image}" class="card-img-top" alt="${product.name}">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="text-muted text-decoration-line-through">$${product.originalPrice}</p>
                        <p class="text-danger">$${product.price} (-${product.discount}%)</p>
                    </div>
                </div>
            </div>
        `;
        flashSaleContainer.innerHTML += productCard;
    });
}

// เรียกฟังก์ชันเมื่อโหลดหน้าเสร็จแล้ว
document.addEventListener("DOMContentLoaded", renderFlashSale);