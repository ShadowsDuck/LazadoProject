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
$sql = "
    SELECT u.fullname, o.status, COUNT(*) as count
    FROM orders o
    INNER JOIN users u ON o.user_id = u.id
    WHERE o.user_id = ?
    GROUP BY u.fullname, o.status
";
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

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header text-black" style="background-color: #dc3545;">
            สถานะคำสั่งซื้อของผู้ใช้ ID: <?php echo $user_id; ?> คุณ <?php echo htmlspecialchars($fullname); ?>
        </div>
        <div class="card-body">
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


