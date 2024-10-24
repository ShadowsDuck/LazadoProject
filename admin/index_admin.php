<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <h1>แดชบอร์ด</h1>
    <div class="row mt-5 text-center">
        <div class="col-md-3">
            <div class="card p-4">
                <?php
                $sql1 = "SELECT * FROM users WHERE usertype='admin'";
                $result1 = mysqli_query($conn, $sql1);
                $row1 = mysqli_num_rows($result1);
                ?>
                <h4 class="fw-bold"><?php echo $row1 ?></h4>
                <p>ผู้ดูแล</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h4 class="fw-bold"></h4>
                <p>สินค้า</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <?php
                $sql3 = "SELECT * FROM orders";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_num_rows($result3);
                ?>
                <h4 class="fw-bold"><?php echo $row3 ?></h4>
                <p>ออเดอร์</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <?php
                $sql4 = "SELECT SUM(total) AS Total FROM orders WHERE status='order'";
                $result4 = mysqli_query($conn, $sql4);
                $row4 = mysqli_fetch_assoc($result4);
                $total_revenue = $row4['Total'];
                ?>
                <h4 class="fw-bold">฿<?php echo $total_revenue ?></h4>
                <p>รายได้ทั้งหมด</p>
            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>