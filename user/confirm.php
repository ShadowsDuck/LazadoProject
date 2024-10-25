<?php
include('partials/header.php'); 
include("../connect.php");
//$host = 'localhost';
///$db = 'lazado_db';
//$user = 'root';
//$password = '';

// สร้างการเชื่อมต่อกับฐานข้อมูล
//$conn = new mysqli($host, $user, $password, $db);
//if ($conn->connect_error) {
//    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
//}

// กำหนดค่าที่อยู่จัดส่งเริ่มต้นถ้ายังไม่มีใน session
if (!isset($_SESSION['shipping_address'])) {
    $_SESSION['shipping_address'] = [
        'fullname' => 'Anonymous',
        'phone' => '',
        'address' => '',
    ];
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มตะกร้าสินค้าหรือไม่
if (isset($_POST['products']) && isset($_POST['quantities'])) {
    $_SESSION['products'] = $_POST['products'];
    $_SESSION['quantities'] = $_POST['quantities'];

    $products = $_SESSION['products'];
    $quantities = $_SESSION['quantities'];

    // สร้าง array สำหรับจัดเก็บข้อมูลสินค้า
    $product_data = [];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    if (!empty($products)) {
        $ids_placeholder = implode(',', array_fill(0, count($products), '?'));
        $stmt = $conn->prepare("SELECT id, name, price, img FROM products WHERE id IN ($ids_placeholder)");

        // เตรียมข้อมูลให้ตรงกับ format ในการใช้ execute
        $stmt->bind_param(str_repeat('i', count($products)), ...$products);
        $stmt->execute();
        $result = $stmt->get_result();

        // จัดเก็บข้อมูลสินค้า
        while ($row = $result->fetch_assoc()) {
            $product_data[$row['id']] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'image' => $row['img']
            ];
        }
        $stmt->close();
    }

    // คำนวณยอดรวมสินค้าที่เลือก
    $total_price = 0;
    foreach ($products as $index => $product_id) {
        if (isset($quantities[$index]) && is_numeric($quantities[$index]) && isset($product_data[$product_id])) {
            $quantity = (int)$quantities[$index];
            $item_total = $product_data[$product_id]['price'] * $quantity;
            $total_price += $item_total;
        }
    }

    // คำนวณค่าจัดส่งตามจำนวนรายการสินค้า
    $unique_items_count = count(array_unique($products)); // นับจำนวนรายการสินค้าไม่ซ้ำ
    $shipping_cost_per_order = $unique_items_count * 50; // 50 บาทต่อรายการ

    // คำนวณยอดรวมทั้งหมด
    $total_amount = $total_price + $shipping_cost_per_order;
} else {
    $total_price = 0;
    $shipping_cost_per_order = 0;
    $total_amount = 0;
}

// ดึงข้อมูลชื่อผู้รับจาก session
$shipping_address = $_SESSION['shipping_address'] ?? [
    'fullname' => 'Anonymous',
    'phone' => '',
    'address' => '',
];

$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
$quantities = isset($_SESSION['quantities']) ? $_SESSION['quantities'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
        }
        .shipping-info,
        .payment-methods,
        .order-summary,
        .cart-item-box {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .cart-item-box img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .cart-item-price {
            color: #ff4d00;
            font-weight: bold;
        }
        .order-summary p {
            margin: 0;
        }
        .order-summary .total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .checkout-btn {
            background-color: #ff4d00;
            color: white;
            padding: 10px 20px;
            border: none;
            width: 100%;
        }
        .checkout-btn:hover {
            background-color: #e64300;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h5>สินค้าที่เลือก</h5>
        <?php if (!empty($product_data)): ?>
            <?php foreach ($products as $index => $product_id): ?>
                <?php if (isset($product_data[$product_id])): ?>
                    <div class="cart-item-box">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo htmlspecialchars($product_data[$product_id]['image']); ?>" alt="Product">
                                <div class="ms-3">
                                    <p><?php echo htmlspecialchars($product_data[$product_id]['name']); ?></p>
                                    <span class="text-muted">จำนวน: <?php echo htmlspecialchars($quantities[$index]); ?></span>
                                </div>
                            </div>
                            <span class="cart-item-price">฿<?php echo number_format($product_data[$product_id]['price'] * (int)$quantities[$index], 2); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>ไม่มีสินค้าที่เลือกในตะกร้า</p>
        <?php endif; ?>
    </div>

    <div class="container mt-4">
        <div class="shipping-info">
            <h5>ที่อยู่จัดส่ง</h5>
            <p><?php echo htmlspecialchars($shipping_address['fullname']); ?>, <?php echo htmlspecialchars($shipping_address['phone']); ?></p>
            <textarea class="form-control" rows="3" readonly><?php echo htmlspecialchars($shipping_address['address']); ?></textarea>
            <form action="edit_address.php" method="POST">
                <button type="submit" class="btn btn-secondary mt-2">แก้ไขที่อยู่</button>
            </form>
        </div>

        <div class="payment-methods mt-4">
            <h5>การชำระเงิน</h5>
            <div>
                <input type="radio" id="cod" name="payment_method" value="cod" checked>
                <label for="cod">ชำระเงินปลายทาง</label>
            </div>
            <div>
                <input type="radio" id="credit_card" name="payment_method" value="credit_card">
                <label for="credit_card">บัตรเครดิต</label>
            </div>
        </div>

        <div class="order-summary mt-4">
            <h5>สรุปคำสั่งซื้อ</h5>
            <p>ยอดรวม: ฿<?php echo number_format($total_price, 2); ?></p>
            <p>ค่าจัดส่ง: ฿<?php echo number_format($shipping_cost_per_order, 2); ?></p>
            <hr>
            <p class="total">ยอดรวมทั้งสิ้น: ฿<?php echo number_format($total_amount, 2); ?></p>
        </div>
        <form method="POST" action="confirm_payment.php">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
            <button type="submit" class="checkout-btn mt-3">สั่งซื้อ</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><br><br><br>
<?php include('partials/footer.php'); ?>


