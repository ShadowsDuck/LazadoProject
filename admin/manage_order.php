<?php include('partials/header.php'); ?>

<!-- Body -->
<div class="container mt-5">
    <h1>จัดการคำสั่งซื้อ</h1>

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
                        <!-- Status field -->
                        <div class="form-group mb-3">
                            <label for="order_status">สถานะการจัดส่ง</label>
                            <select class="form-select" aria-label="order_status">
                                <option value="1">รอการจัดส่ง</option>
                                <option value="2">จัดส่งสำเร็จ</option>
                                <option value="3">ถูกยกเลิก</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" class="btn btn-primary">อัปเดตคำสั่งซื้อ</button>
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
                <th style="width: 20px;">ราคา</th>
                <th style="width: 25px;">จำนวน</th>
                <th style="width: 25px;">ยอดรวม</th>
                <th style="width: 35px;">วันที่สั่งซื้อ</th>
                <th style="width: 30px;">สถานะ</th>
                <th style="width: 50px;">ชื่อลูกค้า</th>
                <th style="width: 40px;">เบอร์โทร</th>
                <th style="width: 50px;">อีเมล</th>
                <th style="width: 50px;">ที่อยู่</th>
                <th style="width: 30px;">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../connect.php');
            $sql = "SELECT * FROM orders";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            $sn = 1;

            if ($row > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $id = $data['id'];
                    $item = $data['item'];
                    $price = $data['price'];
                    $qty = $data['qty'];
                    $total = $data['total'];
                    $order_date = $data['order_date'];
                    $status = $data['status'];
                    $customer_name = $data['customer_name'];
                    $customer_contact = $data['customer_contact'];
                    $customer_email = $data['customer_email'];
                    $customer_address = $data['customer_address'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $item; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#updateOrderModal"
                                data-id="<?php echo $id; ?>"
                                data-fullname="<?php echo $fullname; ?>"
                                data-username="<?php echo $username; ?>">
                                อัปเดต
                            </button>
                        </td>
                    </tr>
                <?php

                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="text-center" style="vertical-align: middle;">ไม่พบข้อมูลผู้ดูแล</td>
                </tr>
            <?php
            }

            ?>

        </tbody>
    </table>
</div>

<?php include('partials/footer.php'); ?>