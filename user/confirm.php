<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Order Summary</h2>

    <?php
    // Assuming that we have a POST request that sends selected items
    $selected_items = $_POST['selected_items']; // Array of selected item IDs

    // Example item data (in a real scenario, you would fetch this from a database)
    $items = [
        ['id' => 1, 'name' => 'Logitech G502 HERO', 'price' => 2400, 'img' => 'https://resource.logitechg.com/...'],
        ['id' => 2, 'name' => 'Razer BlackWidow V3', 'price' => 4200, 'img' => 'https://storage.googleapis.com/...'],
        ['id' => 3, 'name' => 'Acer Predator X27', 'price' => 45000, 'img' => 'https://example.com/acer-monitor.jpg']
    ];

    $total_price = 0;

    // Display selected items
    foreach ($items as $item) {
        if (in_array($item['id'], $selected_items)) {
            echo '<div class="cart-item-box">';
            echo '<div class="cart-item-details">';
            echo '<div class="cart-item-image"><img src="' . $item['img'] . '" alt="' . $item['name'] . '"></div>';
            echo '<div class="cart-item-info">' . $item['name'] . '</div>';
            echo '</div>';
            echo '<div class="cart-item-price">฿' . number_format($item['price'], 2) . '</div>';
            echo '<div class="cart-item-quantity">1</div>';
            echo '<div class="cart-item-total">฿' . number_format($item['price'], 2) . '</div>';
            echo '</div>';
            $total_price += $item['price'];
        }
    }
    ?>

    <!-- Summary Section -->
    <div class="summary-section">
        <h3>Shipping Address</h3>
        <input type="text" placeholder="Enter your shipping address">
    </div>

    <div class="payment-section">
        <h3>Payment Method</h3>
        <select>
            <option value="credit-card">Credit Card</option>
            <option value="bank-transfer">Bank Transfer</option>
        </select>
    </div>

    <!-- Total Section -->
    <div class="total-section">
        <span>Total Price: ฿<?php echo number_format($total_price, 2); ?></span>
        <button class="checkout-btn ms-4">Confirm Order</button>
    </div>

</div>

</body>
</html>
