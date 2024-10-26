<?php
ob_start(); // เริ่มการ buffer output
include('partials/header.php');
include("../connect.php");

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$sql = "SELECT cart.*, products.name, products.price, products.img FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.user_id = '{$_SESSION['id']}'";
$result = $conn->query($sql);

$cartItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
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
    <script>
        window.onload = function() {
            const selectAll = document.getElementById('select-all');
            let itemCheckboxes = document.querySelectorAll('.item-checkbox');

            selectAll.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                calculateSummary();
            });

            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateSummary);
            });

            const minusButtons = document.querySelectorAll('.minus-btn');
            const plusButtons = document.querySelectorAll('.plus-btn');

            minusButtons.forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const input = this.nextElementSibling;
                    if (input.value > 1) {
                        input.value--;
                        updateTotalPrice(input);
                    }
                    calculateSummary();
                });
            });

            plusButtons.forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    const input = this.previousElementSibling;
                    input.value++;
                    updateTotalPrice(input);
                    calculateSummary();
                });
            });

            function updateTotalPrice(input) {
                const row = input.closest('.cart-item-box');
                const price = parseFloat(row.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
                const totalPriceElement = row.querySelector('.cart-item-total');
                const totalPrice = price * input.value;
                totalPriceElement.textContent = `฿${totalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            }

            function calculateSummary() {
                let totalItems = 0;
                let totalPrice = 0;

                itemCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const row = checkbox.closest('.cart-item-box');
                        const quantity = parseInt(row.querySelector('.cart-item-quantity input').value);
                        const pricePerItem = parseFloat(row.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
                        totalItems += quantity;
                        totalPrice += pricePerItem * quantity;
                    }
                });

                document.getElementById('selected-count').textContent = totalItems;
                document.getElementById('total-price').textContent = `฿${totalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            }
        };
    </script>
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

                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item-box">
                        <div><input type="checkbox" class="item-checkbox" name="products[<?php echo $item['product_id']; ?>]" value="<?php echo $item['product_id']; ?>"></div>
                        <div class="cart-item-details">
                            <div class="cart-item-image">
                                <img src="<?php echo $item['img']; ?>" alt="Product Image">
                            </div>
                            <div class="cart-item-info"><?php echo $item['name']; ?></div>
                        </div>
                        <div class="cart-item-price">฿<?php echo number_format($item['price'], 2); ?></div>
                        <div class="cart-item-quantity">
                            <button class="minus-btn">-</button>
                            <input type="text" name="quantities[<?php echo $item['product_id']; ?>]" value="<?php echo $item['qty'] ?>" readonly>
                            <button class="plus-btn">+</button>
                        </div>
                        <div class="cart-item-total">฿<?php echo number_format($item['price'] * $item['qty'], 2); ?></div>
                        <div class="remove-btn" onclick="window.location.href='del_cart.php?id=<?php echo $item['product_id']; ?>'">
                            <i class="bi bi-trash"></i>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="total-section">
                    <span>จำนวนที่เลือก: <span id="selected-count">0</span>ชิ้น</span>
                    <span>ยอดรวม: <span id="total-price">฿0.00</span></span>
                    <button type="submit" class="checkout-btn">สั่งซื้อ</button>
                </div>
            </form>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>

</html>