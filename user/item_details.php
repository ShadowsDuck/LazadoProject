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
                <p>Colours:</p>
                <div>
                    <button class="btn btn-outline-dark btn-sm rounded-circle"
                        style="background-color: #ff0000;"></button>
                    <button class="btn btn-outline-dark btn-sm rounded-circle"
                        style="background-color: #c0c0c0;"></button>
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
                <div class="mt-3">
                    <div class="input-group mb-3" style="max-width: 120px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="2">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                    </div>
                    <button class="btn btn-danger">Buy Now</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-heart"></i></button>
                </div>

            </div>
        </div>
    </div>
</body>

<?php
include("partials/footer.php");
?>