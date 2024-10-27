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
    
    <div class="card shadow-sm border-0">

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
        </div>
    </div>
</div>