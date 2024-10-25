<?php
include '../connect.php';


// รับค่าจาก URL หรือค้นหา
$searchTerm = isset($_GET['name']) ? $conn->real_escape_string($_GET['name']) : '';
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';

// ตรวจสอบการค้นหาจาก name หรือ category
$sql = "SELECT * FROM products WHERE 1=1";
if ($searchTerm) {
    $sql .= " AND name LIKE '%$searchTerm%'";
}
if ($category) {
    $sql .= " AND category = '$category'";
}

$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>

<!-- HTML สำหรับแสดงผลลัพธ์ -->
<div class="container">
    <h3 id="searchResultTitle">ผลลัพธ์การค้นหา</h3>
    <div id="searchResults" class="row">
        <?php if (count($products) == 0): ?>
            <p>ไม่พบสินค้าที่คุณค้นหา</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3">
                    <div class="product-card">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h5><?php echo $product['name']; ?></h5>
                        <p><?php echo $product['price']; ?> บาท</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function searchProduct() {
    const searchQuery = document.getElementById('searchInput').value.trim();
    if (searchQuery) {
        window.location.href = `allitem.php?query=${searchQuery}`;
    }
}

document.getElementById('searchInput').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        searchProduct();
    }
});

document.querySelector('.search-icon-class').addEventListener('click', searchProduct);


function selectCategory(element, category) {
    // เปลี่ยน URL ตามหมวดหมู่ที่เลือก
    window.location.href = `allitem.php?category=${category}`;
}

</script>