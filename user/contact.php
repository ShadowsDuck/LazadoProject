<?php include('partials/header.php'); ?>

    <!-- Body -->
    <div class="container my-5">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body text-center">
                        <div class="fs-1 text-danger mb-3">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h4 class="card-title">Call To Us</h4>
                        <p class="card-text">We are available 24/7, 7 days a week.</p>
                        <p><strong>Phone: +8801611112222</strong></p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="fs-1 text-danger mb-3">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h4 class="card-title">Write To Us</h4>
                        <p>Fill out our form and we will contact you within 24 hours.</p>
                        <p><strong>Emails: customer@lazado.com</strong></p>
                        <p><strong>Emails: support@lazado.com</strong></p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="mb-4">Contact Us</h2>
                        <form action="submit-form.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email *" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="phone" placeholder="Your Phone *" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script/search_result.js"></script>
    <script src="http://localhost/LazadoProject/user/script/search.js"></script>

    <?php include('partials/footer.php'); ?>