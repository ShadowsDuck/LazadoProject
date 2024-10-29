<?php
session_start();

require("../../connect.php");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่า user_id จาก session
$user_id = $_SESSION['id'] ?? 0;

// ดึงสถานะและนับจำนวนสถานะจากตาราง orders
$sql = "SELECT users.fullname, orders.status, COUNT(*) as count
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        WHERE orders.user_id = ?
        GROUP BY users.fullname, orders.status";

$sql1 = "SELECT fullname FROM users WHERE id = {$_SESSION['id']}";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// กำหนดค่าเริ่มต้นของสถานะให้เป็น 0
$statusCounts = [
    '0' => 0,
    '1' => 0,
    '2' => 0,
];

while ($row = $result->fetch_assoc()) {
    $statusCounts[$row['status']] = $row['count'];
    $fullname = $row['fullname'];
}
?>

<div class="container mt-4 ">
    <!-- ปิดการ hover ของ card ใช้ style="pointer-events: none;" -->
    <div class="card shadow-sm border-0" style="pointer-events: none;">

        <div class="card-header text-white bg-dark">
            <h4>สถานะคำสั่งซื้อของฉัน ID: <?php echo $user_id; ?> คุณ <?php echo $row1['fullname']; ?></h4>
        </div>
        <div class="card-body mt-3 ">
            <div class="row">
                <!-- Canceled Orders Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm mb-3" style="background-color: #f8d7da; color: #721c24;">
                        <div class="card-body text-center">
                            <h5 class="card-title">ถูกยกเลิก</h5>
                            <p class="card-text">
                                <?php echo $statusCounts['0']; ?> ชิ้น
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Orders Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm mb-3" style="background-color: #fff3cd; color: #856404;">
                        <div class="card-body text-center">
                            <h5 class="card-title">กำลังจัดส่ง</h5>
                            <p class="card-text">
                                <?php echo $statusCounts['1']; ?> ชิ้น
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Completed Orders Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm mb-3" style="background-color: #d4edda; color: #155724;">
                        <div class="card-body text-center">
                            <h5 class="card-title">สำเร็จ</h5>
                            <p class="card-text">
                                <?php echo $statusCounts['2']; ?> ชิ้น
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th style="width: 20px;">ลำดับ</th>
                        <th style="width: 40px;">สินค้า</th>
                        <th style="width: 25px;">ราคา</th>
                        <th style="width: 25px;">จำนวน</th>
                        <th style="width: 30px;">ยอดรวม</th>
                        <th style="width: 35px;">วันที่สั่งซื้อ</th>
                        <th style="width: 30px;">สถานะ</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Get date range from the form
                    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                    // Modify the query to include INNER JOIN
                    $sql = "SELECT orders.*, products.name FROM orders INNER JOIN products ON orders.product_id = products.id WHERE user_id = {$_SESSION['id']}";
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
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="11" class="text-center">ไม่พบข้อมูลคำสั่งซื้อ</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>