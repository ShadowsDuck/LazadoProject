<?php include('partials/header.php'); ?>


    <!-- Body -->
    <div class="container mt-5">
        <div class="row">
            <!-- Category Menu -->
            <div class="col-md-3">
                <div class="category-menu">
                    <a href="allitem.php">Gaming Gear<i class="bi bi-chevron-right"></i></a>
                    <a href="allitem.php?category=keyboard">Keyboard</a>
                    <a href="allitem.php?category=mouse">Mouse</a>
                    <a href="allitem.php?category=headset">Headset</a>
                    <a href="allitem.php?category=monitor">Monitor</a>
                    <a href="allitem.php?category=chair">Chair</a>
                    <a href="allitem.php?category=streaming">Streaming</a>
                    <a href="allitem.php?category=other">Other<i class="bi bi-chevron-right"></i></a>
                </div>
            </div>

            <!-- Carousel -->
            <div class="col-md-9">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+1" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+2" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+3" alt="Slide 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <h2>Sale</h2>
        <h4>Today's</h4>
        <div class="d-flex justify-content-between align-items-center">

            <div class="row" id="flash-sale-products">
                <!-- Products will be inserted here via JavaScript -->
            </div>
        </div>


        <section class="container my-5">
            <h2 class="text-center mb-4">Best Selling Products</h2>
            <div class="row text-center">
                <!-- Product 1 -->
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/north-coat.jpg" class="card-img-top" alt="The north coat">
                        <div class="card-body">
                            <h5 class="card-title">The north coat</h5>
                            <p class="text-danger"><del>$360</del> $260</p>
                            <p>⭐⭐⭐⭐⭐ (65)</p>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/gucci-bag.jpg" class="card-img-top" alt="Gucci duffle bag">
                        <div class="card-body">
                            <h5 class="card-title">Gucci duffle bag</h5>
                            <p class="text-danger"><del>$1160</del> $960</p>
                            <p>⭐⭐⭐⭐⭐ (65)</p>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/rgb-cpu-cooler.jpg" class="card-img-top" alt="RGB liquid CPU Cooler">
                        <div class="card-body">
                            <h5 class="card-title">RGB liquid CPU Cooler</h5>
                            <p class="text-danger"><del>$170</del> $160</p>
                            <p>⭐⭐⭐⭐⭐ (65)</p>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/bookshelf.jpg" class="card-img-top" alt="Small BookSelf">
                        <div class="card-body">
                            <h5 class="card-title">Small BookSelf</h5>
                            <p class="text-danger">$360</p>
                            <p>⭐⭐⭐⭐⭐ (65)</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- View All Products Button -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-danger">View All Products</a>
        </div>

    </div>
    <div class="container mt-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+1" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+2" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/900x300.png?text=Placeholder+Image+3" alt="Slide 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <!-- Browse By Category Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Browse By Category</h2>
        <div class="row text-center">
            <div class="col-md-2">
                <div class="category-item p-4" onclick="searchByCategory('keyboard')">
                    <i class="bi bi-keyboard" style="font-size: 2rem;"></i>
                    <p>Keyboard</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item p-4" onclick="searchByCategory('mouse')">
                    <i class="bi bi-mouse" style="font-size: 2rem;"></i>
                    <p>Mouse</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item p-4" onclick="searchByCategory('headset')">
                    <i class="bi bi-headset" style="font-size: 2rem;"></i>
                    <p>Headset</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item p-4" onclick="searchByCategory('monitor')">
                    <i class="bi bi-display" style="font-size: 2rem;"></i>
                    <p>Monitor</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item p-4" onclick="searchByCategory('chair')">
                    <i class="bi bi-chair" style="font-size: 2rem;"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSitzzI-H5Sdgz6VdbHhEwcubyUv0kmiO57ZA&s" style="height: 25%; width: 26%;"></i>
                    <p>Chair</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category-item p-4" onclick="searchByCategory('streaming')">
                    <i class="bi bi-broadcast-pin" style="font-size: 2rem;"></i>
                    <p>Steaming</p>
                </div>
            </div>
        </div>
    </section>


    
    <?php include('partials/footer.php'); ?>

