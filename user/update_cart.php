<?php
session_start();
include("../connect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['product_id']) && isset($_POST['qty'])) {
    $productId = $_POST['product_id'];
    $qty = $_POST['qty'];
    $userId = $_SESSION['id'];

    // อัปเดตค่า qty ในฐานข้อมูล
    $sql = "UPDATE cart SET qty = ? WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $qty, $productId, $userId);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Quantity updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update quantity."]);
    }

    $stmt->close();
}

$conn->close();
?>
