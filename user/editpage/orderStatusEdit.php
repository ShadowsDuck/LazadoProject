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
    'ถูกยกเลิก' => 0,
    'กำลังจัดส่ง' => 0,
    'สำเร็จ' => 0,
];

while ($row = $result->fetch_assoc()) {
    $statusCounts[$row['status']] = $row['count'];
    $fullname = $row['fullname'];
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            สถานะคำสั่งซื้อของผู้ใช้ ID: <?php echo $user_id; ?> คุณ <?php echo htmlspecialchars($fullname); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">ถูกยกเลิก</h5>
                            <p class="card-text">
                                <?php echo $statusCounts['ถูกยกเลิก']; ?> ชิ้น
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">กำลังจัดส่ง</h5>
                            <p class="card-text">
                                <?php echo $statusCounts['กำลังจัดส่ง']; ?> ชิ้น
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">สำเร็จ</h5>
                            <p class="card-text">
                                <?php echo $statusCounts['สำเร็จ']; ?> ชิ้น
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


