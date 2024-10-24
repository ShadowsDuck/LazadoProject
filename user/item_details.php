<?php
include("partials/header.php");
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
                <h3>Product's name</h3>
                <p><span class="text-warning">★★★★☆</span> (n Reviews) | <span class="text-success">In Stock</span>
                </p>
                <h4>$1.00</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores illo voluptas repellendus commodi
                    nobis veritatis corporis, quas eum? Deleniti hic nesciunt eos. Similique hic qui, tenetur mollitia
                    numquam dolorem expedita.</p>

                <!-- Colour Options -->
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2">Colours:</p>
                    <button class="btn btn-outline-dark btn-sm rounded-circle me-2"
                        style="background-color: #ff0000; width: 20px; height: 20px;"></button>
                    <button class="btn btn-outline-dark btn-sm rounded-circle"
                        style="background-color: #c0c0c0; width: 20px; height: 20px;"></button>
                </div>


                <!-- Size Options -->
                <p class="mt-3">Size:</p>
                <div>
                    <button class="btn btn-outline-dark btn-sm">XS</button>
                    <button class="btn btn-outline-dark btn-sm">S</button>
                    <button class="btn btn-dark btn-sm">M</button>
                    <button class="btn btn-outline-dark btn-sm">L</button>
                    <button class="btn btn-outline-dark btn-sm">XL</button>
                </div>

                <!-- Quantity and Buy Now -->
                <div class="mt-3 mb-3">
                    <?php $quantity = 1; ?>
                    <div class="input-group mb-3" style="max-width: 120px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">-</button>
                        <input type="text" id="quantity" class="form-control text-center"
                            value="<?php echo $quantity; ?>">
                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">+</button>
                    </div>
                </div>
                <button class="btn btn-danger">Buy Now</button>
                <button class="btn btn-outline-secondary"><i class="bi bi-heart"></i></button>
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
</script>

<?php
include("partials/footer.php");
?>