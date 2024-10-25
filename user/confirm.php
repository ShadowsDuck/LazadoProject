<?php
session_start();

// กำหนดค่าที่อยู่จัดส่งเริ่มต้นถ้ายังไม่มีใน session
if (!isset($_SESSION['shipping_address'])) {
    $_SESSION['shipping_address'] = [
        'name' => '',
        'phone' => '',
        'address' => '',
    ];
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มตะกร้าสินค้าหรือไม่
if (isset($_POST['products'])) {
    $_SESSION['products'] = $_POST['products']; // เก็บสินค้าที่เลือกลงใน session
    $_SESSION['quantities'] = $_POST['quantity']; // เก็บจำนวนสินค้าที่เลือกลงใน session

    $products = $_SESSION['products'];
    $quantities = $_SESSION['quantities'];
    $total_price = 0;
    $shipping_cost_per_order = 50; // ค่าจัดส่งต่อการสั่งซื้อหนึ่งครั้ง

    // คำนวณยอดรวมสินค้าที่เลือก
    foreach ($products as $index => $product_id) {
        $product_data = [
            'id' => $product_id,
            'name' => 'ชื่อสินค้าที่ ' . $product_id,
            'price' => 300, // ราคาสินค้าต่อชิ้น
            'image' => 'https://via.placeholder.com/80'
        ];

        $quantity = $quantities[$index];
        $item_total = $product_data['price'] * $quantity;
        $total_price += $item_total;
    }

    // คำนวณยอดรวมทั้งหมด
    $total_amount = $total_price + $shipping_cost_per_order; // ค่าจัดส่งคิด 50 บาทต่อการสั่งซื้อ
} else {
    // ถ้าไม่มีสินค้าที่เลือก ยอดรวมทั้งหมดเป็น 0
    $total_price = 0;
    $shipping_cost_per_order = 0;
    $total_amount = 0; 
}

// แก้ไขที่อยู่จัดส่ง
if (isset($_POST['save_address'])) {
    $_SESSION['shipping_address']['name'] = $_POST['name'];
    $_SESSION['shipping_address']['phone'] = $_POST['phone'];
    $_SESSION['shipping_address']['address'] = $_POST['address'];
}

// กำหนดค่าจาก session สำหรับแสดงผล
$shipping_address = $_SESSION['shipping_address'];
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
        }

        .shipping-info,
        .payment-methods,
        .order-summary {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

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
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container mt-4">
            <a class="navbar-brand fw-bold fs-3" href="index.php">Lazado</a>
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
                        <a class="nav-link" href="#">สมัครสมาชิก</a>
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
    <div class="container mt-4">

        <div class="row">

            <div class="col-md-8">

                <div class="shipping-info">
                    <h5>ที่อยู่จัดส่ง</h5>
                    <p><?php echo $shipping_address['name']; ?>, <?php echo $shipping_address['phone']; ?></p>
                    <p><?php echo $shipping_address['address']; ?></p>
                    <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editAddressModal">แก้ไข</button>
                </div>

                <!-- Cart Items -->
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $index => $product_id): ?>
                        <div class="cart-item-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/80" alt="Product">
                                    <div class="ms-3">
                                        <p>ชื่อสินค้าที่ <?php echo $product_id; ?></p>
                                        <span class="text-muted">จำนวน: <?php echo $quantities[$index]; ?></span>
                                    </div>
                                </div>
                                <span class="cart-item-price">฿<?php echo number_format(300 * $quantities[$index], 2); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>ไม่มีสินค้าที่ถูกเลือกในตะกร้า</p>
                <?php endif; ?>

            </div>

            <div class="col-md-4">

                <div class="payment-methods">
                    <h5>เลือกวิธีการชำระเงิน</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment1" checked>
                        <label class="form-check-label" for="payment1">
                            ชำระเงินปลายทาง
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment2">
                        <label class="form-check-label" for="payment2">
                            บัตรเครดิต/เดบิต
                        </label>
                    </div>
                </div>

                <div class="order-summary">
                    <h5>สรุปคำสั่งซื้อ</h5>
                    <p>ยอดรวม: ฿<?php echo number_format($total_price, 2); ?></p>
                    <p>ค่าจัดส่ง: ฿<?php echo number_format($shipping_cost_per_order, 2); ?></p>
                    <hr>
                    <p class="total">ยอดรวมทั้งสิ้น: ฿<?php echo number_format($total_amount, 2); ?></p>
                    <button class="checkout-btn mt-3">สั่งซื้อ</button>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal for Editing Address -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAddressModalLabel">แก้ไขที่อยู่จัดส่ง</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($shipping_address['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($shipping_address['phone']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">ที่อยู่</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo htmlspecialchars($shipping_address['address']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" name="save_address" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; 2024 Lazado. สงวนสิทธิ์ทั้งหมด.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
