<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            overflow: hidden;
            border-radius: 8px;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
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
            const removeButtons = document.querySelectorAll('.remove-btn');

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

            removeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm("แน่ใจหรือไม่ว่าต้องการลบสินค้านี้?")) {
                        const row = this.closest('.cart-item-box');
                        row.remove();

                        // Update itemCheckboxes after removing an item
                        itemCheckboxes = document.querySelectorAll('.item-checkbox');

                        // Recalculate total
                        calculateSummary();
                    }
                });
            });

            function updateTotalPrice(input) {
                const row = input.closest('.cart-item-box');
                const price = parseFloat(row.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
                const totalPriceElement = row.querySelector('.cart-item-total');
                const totalPrice = price * input.value;
                totalPriceElement.textContent = `฿${totalPrice.toLocaleString()}`;
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
                document.getElementById('total-price').textContent = `฿${totalPrice.toLocaleString()}`;
            }
        };
    </script>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container mt-4">
            <a class="navbar-brand fw-bold fs-3" href="index.php">Lazado</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="#">เข้าสู่ระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <h2 class="text-center">ตะกร้าสินค้า</h2>
        <div class="cart-table">
            <form action="confirm.php" method="POST">
                <div class="header-row">
                    <div><input type="checkbox" id="select-all"></div>
                    <div>สินค้า</div>
                    <div>ราคา</div>
                    <div>จำนวน</div>
                    <div>รวม</div>
                    <div>ลบ</div>
                </div>

                <?php
                // สมมติว่ามีสินค้าหลายตัวในตะกร้า
                $cartItems = [
                    ['id' => 1, 'name' => 'Hyper X cloud 3', 'price' => 30000.00, 'image' => 'https://img.lazcdn.com/g/p/3d44752b4e2d18277dd9bb19362fadb7.jpg_2200x2200q80.jpg_.webp'],
                    ['id' => 2, 'name' => 'จิ๋มกระป๋อง', 'price' => 1500.00, 'image' => 'https://img.lazcdn.com/g/p/d549b1b77e0607ee34641b4401756082.jpg_2200x2200q80.jpg_.webp']
                ];

                foreach ($cartItems as $item) {
                    echo '<div class="cart-item-box">';
                    echo '<div><input type="checkbox" class="item-checkbox" name="products[]" value="' . $item['id'] . '"></div>';
                    echo '<div class="cart-item-details">';
                    echo '<div class="cart-item-image"><img src="' . $item['image'] . '" alt="Product Image"></div>';
                    echo '<div class="cart-item-info">' . $item['name'] . '</div>';
                    echo '</div>';
                    echo '<div class="cart-item-price">฿' . number_format($item['price'], 2) . '</div>';
                    echo '<div class="cart-item-quantity"><button class="minus-btn" type="button">-</button><input type="number" name="quantity[]" min="1" value="1" readonly><button class="plus-btn" type="button">+</button></div>';
                    echo '<div class="cart-item-total">฿' . number_format($item['price'], 2) . '</div>';
                    echo '<div><span class="remove-btn"><i class="bi bi-trash"></i></span></div>';
                    echo '</div>';
                }
                ?>

                <div class="total-section">
                    <span>จำนวนสินค้า: <span id="selected-count">0</span></span>
                    <span>ราคาสุทธิ: <span id="total-price">฿0.00</span></span>
                    <button type="submit" class="checkout-btn">สั่งซื้อ</button>
                </div>
            </form>
        </div>
    </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <h5>เกี่ยวกับเรา</h5>
            <p>ข้อมูลเกี่ยวกับเรา | นโยบายการคืนสินค้า | เงื่อนไขการให้บริการ</p>
            <p>© 2024 Lazado, Inc. สงวนลิขสิทธิ์</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-Ksvz4snC3q6TyZGT3g8LHFuqen9Z3tdwkjZzO8gCPY4g1aL3Ev1Gv/OLd0PqWbpp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-3Xtf3XhFdkCwG3jCPo/rFq1g5S9XG+Sx68H6V9dXsjOkcY+U6EkNxPpyk3t41qI0" crossorigin="anonymous"></script>
</body>

</html>
