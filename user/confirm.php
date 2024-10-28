<?php
include('partials/header.php');
include("../connect.php");

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ตรวจสอบว่าสินค้าใดถูกเลือกจาก cart.php
$selectedProducts = isset($_POST['products']) ? array_keys($_POST['products']) : [];

if (empty($selectedProducts)) {
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "กรุณาเลือกสินค้าในตะกร้า!";
        header("Location: {$base_url}/user/cart.php");
        exit();
    } else {
        $_SESSION['message'] = "เกิดข้อผิดพลาดในเลือกสินค้าในตะกร้า!: " . mysqli_error($conn);
        header("Location: {$base_url}/user/cart.php");
        exit();
    }
    exit;
}

// ดึงข้อมูลสินค้าเฉพาะที่ถูกเลือก
$sql = "SELECT cart.*, products.name, products.price, products.file_name, products.discount, products.discounted_price 
        FROM cart 
        INNER JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = '{$_SESSION['id']}' 
        AND cart.product_id IN (" . implode(',', array_map('intval', $selectedProducts)) . ")";
$result = $conn->query($sql);

$cartItems = [];
$total_price = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) { // $row = mysqli_fetch_array($result)
        $cartItems[] = $row;
        // คำนวณราคาทั้งหมดโดยคูณราคากับจำนวนที่ถูกเลือก
        if ($row['discount'] == 1) {
            $total_price += $row['discounted_price'] * $row['qty'];
        } else {
            $total_price += $row['price'] * $row['qty'];
        }
    }
} else {
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "กรุณาเลือกสินค้าในตะกร้า!";
        header("Location: {$base_url}/user/cart.php");
        exit();
    } else {
        $_SESSION['message'] = "เกิดข้อผิดพลาดในเลือกสินค้าในตะกร้า!: " . mysqli_error($conn);
        header("Location: {$base_url}/user/cart.php");
        exit();
    }
    exit;
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$user_id = $_SESSION['id'];
$user_sql = "SELECT fullname, address FROM users WHERE id = '$user_id'";
$user_result = $conn->query($user_sql);
$shipping_address = $user_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปคำสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
        }

        .shipping-info,
        .payment-methods,
        .order-summary,
        .cart-item-box,
        .shipping-options {
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
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            width: 100%;
        }

        .checkout-btn:hover {
            background-color: #c82333;
        }

        .shipping-option {
            border: 1px solid #007bff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .shipping-option input[type="radio"] {
            margin-right: 10px;
            /* เว้นระยะระหว่าง radio button กับข้อความ */
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h5>สินค้าที่เลือก</h5>
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item-box ">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <?php
                            $imageURL = !empty($item['file_name']) ? '../uploads/' . $item['file_name'] : 'https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg';
                            ?>
                            <img src="<?php echo $imageURL ?>" class="card-img-top mb-3" alt="Image" width="200px" loading="lazy">
                            <div class="ms-3">
                                <p><?php echo htmlspecialchars($item['name']); ?></p>
                                <span class="text-muted">จำนวน: <?php echo htmlspecialchars($item['qty']); ?></span>
                            </div>
                        </div>
                        <span class="cart-item-price text-dark"><?php
                                                        if ($item['discount'] == 1 && !empty($item['discounted_price'])) {
                                                            echo "฿" . number_format($item['discounted_price'] * $item['qty'], 2); // แสดงราคาที่ลดแล้ว
                                                        } else {
                                                            echo "฿" . number_format($item['price'] * $item['qty'], 2); // แสดงราคาปกติ
                                                        }
                                                        ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>ไม่มีสินค้าในตะกร้า </p>
        <?php endif; ?>
    </div>

    <div class="container mt-4">
        <div class="shipping-info">
            <h5>ผู้รับ/ที่อยู่จัดส่ง</h5>
            <p><?php echo htmlspecialchars($shipping_address['fullname']); ?></p>
            <p><?php echo htmlspecialchars($shipping_address['address']); ?></p>
            
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

        <div class="shipping-options">
            <h5>ตัวเลือกการจัดส่ง</h5>
            <div class="shipping-option">
                <input type="radio" id="standard_shipping" name="shipping_method" value="standard">
                <label for="standard_shipping">ส่งแบบธรรมดา (ได้รับของภายในสองวันหลังสั่งของ)</label>
            </div>
            <div class="shipping-option">
                <input type="radio" id="express_shipping" name="shipping_method" value="express">
                <label for="express_shipping">จัดส่งแบบไวมาก (ได้รับของภายใน 1 วันหลังสั่งของ)</label>
            </div>
        </div>

        <div class="order-summary mt-4">
            <h5>สรุปคำสั่งซื้อ</h5>

            <!-- <p>ค่าจัดส่ง: ฿<?php echo number_format($shipping_cost_per_order, 2); ?></p> -->
            <hr>
            <p class="total text-danger">ยอดรวมทั้งสิ้น: <?php echo number_format($total_price, 2); ?>
             บาท</p>
        </div>

        <form method="POST" action="confirm_payment.php">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
            <!-- แปลงเป็น json ให้ tag input ส่งค่าได้ -->
            <input type="hidden" name="cartItems" value="<?php echo htmlspecialchars(json_encode($cartItems), ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount ?>">
            <input type="hidden" name="shipping_address" value="<?php echo htmlspecialchars($shipping_address['address']); ?>">
            <input type="hidden" name="discount" value="<?php echo isset($item['discount']) && $item['discount'] == 1 ? 1 : 0; ?>">
            <button type="submit" class="checkout-btn btn-danger mt-3">สั่งซื้อ</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include('partials/footer.php');
$conn->close();
?>