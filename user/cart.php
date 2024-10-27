<?php
ob_start(); // เริ่มการ buffer output
include('partials/header.php');
include("../connect.php");

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ปรับการ Query ข้อมูลให้รวมข้อมูล discount และ discounted_price
$sql = "SELECT cart.*, products.name, products.price, products.discount, products.discounted_price, products.img 
        FROM cart 
        INNER JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = '{$_SESSION['id']}'";
$result = $conn->query($sql);

$cartItems = [];
$totalQuantity = 0; // ตัวแปรสำหรับนับจำนวนสินค้าทั้งหมด
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
        $totalQuantity += $row['qty']; // นับจำนวนสินค้าในตะกร้า
    }
}
$conn->close();

ob_end_flush(); // ปิดการ buffer output
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f8f9fa;
        }

        .table {
            width: 100%;
            table-layout: fixed;
        }

        .header-row {
            display: grid;
            grid-template-columns: 50px 1fr 1fr 1fr 1fr 50px;
            align-items: center;
            padding: 15px 0;
            font-weight: bold;
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .header-row div {
            text-align: center;
        }

        .cart-item-box {
            display: grid;
            grid-template-columns: 50px 1fr 1fr 1fr 1fr 50px;
            align-items: center;
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .cart-item-details {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .cart-item-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .cart-item-info {
            font-size: 1rem;
            font-weight: 600;
            color: #343a40;
            text-align: left;
        }

        .cart-item-price,
        .cart-item-total {
            font-size: 1.1rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item-quantity input {
            width: 70px;
            height: 35px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .remove-btn {
            color: red;
            font-size: 1.2rem;
            cursor: pointer;
            text-align: center;
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            font-weight: bold;
            margin-top: 30px;
        }

        .total-section span {
            font-size: 1.3rem;
            margin-right: 20px;
        }

        .checkout-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-left: 20px;
        }

        .checkout-btn:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }

        footer h5 {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <h2 class="text-center">ตะกร้าสินค้า</h2>
        <div class="cart-table">
            <form action="confirm.php" method="POST">
                <div class="header-row">
                    <div><input type="checkbox" id="select-all"></div>
                    <div>สินค้า</div>
                    <div>ราคา/ชิ้น</div>
                    <div>จำนวน</div>
                    <div>รวม</div>
                    <div>ลบ</div>
                </div>

                <?php
                $totalPrice = 0; // สำหรับเก็บราคารวมทั้งหมด
                foreach ($cartItems as $item):
                    $displayPrice = $item['discount'] ? $item['discounted_price'] : $item['price'];
                    $itemTotal = $displayPrice * $item['qty'];
                    $totalPrice += $itemTotal;
                ?>
                    <div class="cart-item-box">
                        <div><input type="checkbox" class="item-checkbox" name="products[<?php echo $item['product_id']; ?>]" value="<?php echo $item['product_id']; ?>"></div>
                        <div class="cart-item-details">
                            <div class="cart-item-image">
                                <img src="<?php echo $item['img']; ?>" alt="Product Image">
                            </div>
                            <div class="cart-item-info"><?php echo $item['name']; ?></div>
                        </div>
                        <div class="cart-item-price">฿<?php echo number_format($displayPrice, 2); ?></div>
                        <div class="cart-item-quantity">
                            <button type="button" class="minus-btn">-</button>
                            <input type="text" name="quantities[<?php echo $item['product_id']; ?>]" value="<?php echo $item['qty']; ?>" readonly>
                            <button type="button" class="plus-btn">+</button>
                        </div>
                        <div class="cart-item-total">฿<?php echo number_format($itemTotal, 2); ?></div>
                        <div class="remove-btn" onclick="window.location.href='del_cart.php?id=<?php echo $item['id']; ?>'">
                            <i class="bi bi-trash"></i>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="total-section">
                    <span>สินค้าที่เลือกแล้ว: <span id="total-quantity">0</span> ชิ้น</span>
                    <span>ยอดรวมทั้งหมด: <span id="selected-price">฿0.00</span></span>
                    <button type="submit" class="checkout-btn">สั่งซื้อ</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cartItems = <?php echo json_encode($cartItems); ?>; // ส่งข้อมูล cartItems ไปยัง JS
            const selectAllCheckbox = document.getElementById('select-all');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');

            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateTotalQuantity(); // อัปเดตจำนวนสินค้าที่เลือก
                updateSelectedTotal(); // อัปเดตยอดรวมของสินค้าที่เลือก
            });

            const plusButtons = document.querySelectorAll('.plus-btn');
            const minusButtons = document.querySelectorAll('.minus-btn');

            plusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    let qty = parseInt(input.value);
                    input.value = qty + 1;
                    updateTotalPrice(this.closest('.cart-item-box'));
                    updateTotalQuantity(); // อัปเดตจำนวนสินค้าทั้งหมด
                    updateSelectedTotal(); // อัปเดตยอดรวมของสินค้าที่เลือก
                });
            });

            minusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.nextElementSibling;
                    let qty = parseInt(input.value);
                    if (qty > 1) {
                        input.value = qty - 1;
                        updateTotalPrice(this.closest('.cart-item-box'));
                        updateTotalQuantity(); // อัปเดตจำนวนสินค้าทั้งหมด
                        updateSelectedTotal(); // อัปเดตยอดรวมของสินค้าที่เลือก
                    }
                });
            });

            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotalQuantity(); // อัปเดตจำนวนสินค้าทันทีเมื่อเลือก checkbox
                    updateSelectedTotal(); // อัปเดตยอดรวมของสินค้าที่เลือก
                });
            });

            function updateTotalQuantity() {
                let totalQuantity = 0;
                itemCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const qtyInput = checkbox.closest('.cart-item-box').querySelector('input[type="text"]');
                        const qty = parseInt(qtyInput.value);
                        if (!isNaN(qty)) {
                            totalQuantity += qty;
                        }
                    }
                });
                document.getElementById('total-quantity').textContent = totalQuantity; // แสดงจำนวนทั้งหมด
            }

            function updateTotalPrice(cartItemBox) {
                const price = parseFloat(cartItemBox.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
                const qty = parseInt(cartItemBox.querySelector('input[type="text"]').value);
                const total = price * qty;
                cartItemBox.querySelector('.cart-item-total').textContent = '฿' + total.toFixed(2);
                updateTotalPriceOverall(); // เรียกใช้ฟังก์ชันเพื่ออัปเดตยอดรวมทั้งหมด
            }

            function updateTotalPriceOverall() {
                let totalPrice = 0;
                document.querySelectorAll('.cart-item-total').forEach(total => {
                    totalPrice += parseFloat(total.textContent.replace('฿', '').replace(',', ''));
                });
                document.getElementById('selected-price').textContent = '฿' + totalPrice.toFixed(2); // แสดงยอดรวมที่เลือก
            }


            function updateSelectedTotal() {
                let selectedTotalPrice = 0;
                itemCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const cartItemBox = checkbox.closest('.cart-item-box');
                        const price = parseFloat(cartItemBox.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
                        const qty = parseInt(cartItemBox.querySelector('input[type="text"]').value);
                        selectedTotalPrice += price * qty; // คำนวณยอดรวม
                    }
                });
                document.getElementById('selected-price').textContent = '฿' + selectedTotalPrice.toFixed(2); // แสดงยอดรวมที่เลือก
            }

            // ตั้งค่าเริ่มต้นให้แสดง 0 ในช่วงเริ่มต้น
            document.getElementById('total-quantity').textContent = 0;
        });
    </script>

    <footer>
        <div class="container text-center">
            <h5>ข้อมูลเพิ่มเติม</h5>
            <p>จัดทำโดยทีมงานของเรา</p>
            <a href="#">นโยบายการคืนสินค้า</a> | <a href="#">ข้อมูลการติดต่อ</a>
        </div>
    </footer>
</body>

</html>