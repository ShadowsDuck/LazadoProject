<?php
include("partials/header.php");
require("../connect.php");

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<body>
    <!-- Product Section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-7">
                <div class="row">
                    <div class="col-3">
                        <img src="https://placehold.co/500" class="img-fluid mb-3" alt="Product Image">
                        <img src="https://placehold.co/500" class="img-fluid mb-3" alt="Product Image">
                        <img src="https://placehold.co/500" class="img-fluid mb-3" alt="Product Image">
                        <img src="https://placehold.co/500" class="img-fluid mb-3" alt="Product Image">
                    </div>
                    <div class="col-9">
                        <img src="https://placehold.co/500" class="img-fluid" alt="Main Product Image">
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-5">
                <h3><?php echo $row['name'] ?></h3>
                <!-- <p><span class="text-warning">★★★★☆</span> (n Reviews) | <span class="text-success">In Stock</span> -->
                </p>
                <h3><?php echo "฿".number_format($row['price'],2); ?></h3>
                <p><?php echo $row['description']?></p>

                <form action="add_to_cart.php?id=<?php echo $product_id ?>" method="POST">
                    <!-- Quantity and Buy Now -->
                    <div class="mt-3 mb-3">
                        <div class="input-group mb-3 " style="max-width: 120px;">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="decreaseQuantity()">-</button>
                            <input type="text" id="quantity" name="quantity" class="form-control text-center" value="1"
                                oninput="validateQuantity()">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-lg" value="submit">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function increaseQuantity() {
        var quantityInput = document.getElementById("quantity");
        var currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    }

    function decreaseQuantity() {
        var quantityInput = document.getElementById("quantity");
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) { // ตรวจสอบไม่ให้ค่าเป็น 0 หรือต่ำกว่า
            quantityInput.value = currentValue - 1;
        }
    }

    function validateQuantity() {
        var quantityInput = document.getElementById("quantity");
        var value = quantityInput.value;

        // ถ้าไม่ใช่ตัวเลข หรือเป็นเลขติดลบ ให้คืนค่าเป็น 1
        if (isNaN(value) || value <= 0) {
            quantityInput.value = 1;
        }
    }

    function setActive(event, button) {
        event.preventDefault(); // ป้องกันการ submit form

        var buttons = document.querySelectorAll('#btn button');
        buttons.forEach(function (btn) {
            btn.style.border = '0';
        });
        button.style.border = '2px solid black';
    }
</script>

<?php
include("partials/footer.php");
?>