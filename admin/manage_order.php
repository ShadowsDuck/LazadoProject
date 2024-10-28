<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <h1>จัดการคำสั่งซื้อ</h1>

    <!-- Date range filter button -->
    <button type="button" class="btn btn-primary mt-2 mb-4 float-end" data-bs-toggle="modal" data-bs-target="#filterOrderModal">
        กรองข้อมูล
    </button>

    <!-- Modal for Filtering Orders -->
    <div class="modal fade" id="filterOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="filterOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" action="" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterOrderModalLabel">กรองคำสั่งซื้อ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Date range fields -->
                        <div class="form-group mb-3">
                            <label for="start_date">วันที่เริ่มต้น</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                            <div class="invalid-feedback">
                                กรุณาเลือกวันที่เริ่มต้น
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="end_date">วันที่สิ้นสุด</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                            <div class="invalid-feedback">
                                กรุณาเลือกวันที่สิ้นสุด
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary">กรองข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Update Order -->
    <div class="modal fade" id="updateOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateOrderForm" action="update_order.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateOrderModalLabel">อัปเดตคำสั่งซื้อ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="order_id">

                        <!-- Status field -->
                        <div class="form-group mb-3">
                            <label for="order_status">สถานะการจัดส่ง</label>
                            <select class="form-select" name="order_status" aria-label="order_status">
                                <option value="1">รอการจัดส่ง</option>
                                <option value="2">จัดส่งสำเร็จ</option>
                                <option value="0">ถูกยกเลิก</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary second">อัปเดตคำสั่งซื้อ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover mt-5">
        <thead>
            <tr>
                <th style="width: 20px;">ลำดับ</th>
                <th style="width: 40px;">สินค้า</th>
                <th style="width: 25px;">ราคา</th>
                <th style="width: 25px;">จำนวน</th>
                <th style="width: 30px;">ยอดรวม</th>
                <th style="width: 35px;">วันที่สั่งซื้อ</th>
                <th style="width: 30px;">สถานะ</th>
                <th style="width: 40px;">ชื่อลูกค้า</th>
                <th style="width: 43px;">อีเมล</th>
                <th style="width: 45px;">ที่อยู่</th>
                <th style="width: 35px;">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../connect.php');

            // Get date range from the form
            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

            // Modify the query to include INNER JOIN
            $sql = "SELECT orders.*, products.name FROM orders INNER JOIN products ON orders.product_id = products.id";
            if ($start_date && $end_date) {
                $sql .= " WHERE order_date BETWEEN '$start_date' AND '$end_date'";
            }

            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            $sn = 1;

            if ($row > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $id = $data['id'];
                    $product = $data['name'];
                    $price = $data['price'];
                    $qty = $data['qty'];
                    $total = $data['total'];
                    $order_date = $data['order_date'];
                    $status = $data['status'];
                    $customer_name = $data['customer_name'];
                    $customer_email = $data['customer_email'];
                    $customer_address = $data['customer_address'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo strlen($product) > 20 ? substr($product, 0, 20) . "..." : $product; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>
                            <?php
                            if ($status == '1') {
                                echo '<span class="text-warning">รอการจัดส่ง</span>';
                            } elseif ($status == '2') {
                                echo '<span class="text-success">จัดส่งสำเร็จ</span>';
                            } elseif ($status == '0') {
                                echo '<span class="text-danger">ถูกยกเลิก</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#updateOrderModal"
                                data-id="<?php echo $id; ?>"
                                data-status="<?php echo $status; ?>">
                                อัปเดต
                            </button>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="11" class="text-center">ไม่พบข้อมูลคำสั่งซื้อในช่วงเวลาที่เลือก</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>

<?php include('partials/footer.php'); ?>
<script>
    var updateOrderModal = document.getElementById('updateOrderModal');
    updateOrderModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var status = button.getAttribute('data-status');

        var modal = this;
        modal.querySelector('#order_id').value = id;
        modal.querySelector('select[name="order_status"]').value = status;
    });
</script>