<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap E-Commerce Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .navbar-nav {
            margin: auto;
        }

        .input-group-text {
            cursor: pointer;
        }

        .category-menu {
            padding-top: 0px;
        }
        .category-menu a {
            display: block;
            margin-bottom: 15px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .carousel-item img {
            width: 100%;
            height: 340px;
            object-fit: cover;
        }
        .carousel-control-prev, .carousel-control-next {
            filter: invert(100%); /* ทำให้ลูกศรสีขาวมองเห็นได้ดีขึ้น */
        }

        .container-fluid {
            padding-left: 30px; /* เพิ่ม padding-left */
            padding-right: 30px; /* เพิ่ม padding-right */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container mt-4">
            <a class="navbar-brand fw-bold fs-3" href="#">Lazado</a>
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

    <!-- Body -->
    <div class="container mt-5">
        <div class="row">
            <!-- Category Menu -->
            <div class="col-md-3">
                <div class="category-menu">
                    <a href="#">Woman's Fashion <i class="bi bi-chevron-right"></i></a>
                    <a href="#">Men's Fashion <i class="bi bi-chevron-right"></i></a>
                    <a href="#">Electronics</a>
                    <a href="#">Home & Lifestyle</a>
                    <a href="#">Medicine</a>
                    <a href="#">Sports & Outdoor</a>
                    <a href="#">Baby's & Toys</a>
                    <a href="#">Groceries & Pets</a>
                    <a href="#">Health & Beauty</a>
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

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Exclusive</h5>
                    <p>Get 10% off your first order</p>
                </div>
                <div class="col-md-3">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">FAQ</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <!-- เพิ่มเนื้อหาส่วนท้ายเพิ่มเติมได้ที่นี่ -->
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>