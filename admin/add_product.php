<?php
session_start();
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $targetDir = "../uploads/";
    $fileName = "";

    // Validate category selection
    if (empty($category)) {
        $_SESSION['message'] = "กรุณาเลือกหมวดหมู่สินค้า";
        $_SESSION['success'] = false;
        header("Location: {$base_url}/admin/add_product.php");
        exit();
    }

    // Handle file upload if provided
    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // File upload successful
            } else {
                $_SESSION['message'] = "File upload failed. Please try again.";
                header("Location: {$base_url}/admin/add_product.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header("Location: {$base_url}/admin/add_product.php");
            exit();
        }
    }

    // Insert product data
    $sql = "INSERT INTO products (name, description, price, category, created_at, file_name, available) VALUES ('$name', '$description', '$price', '$category', NOW(), '$fileName', '1')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "สินค้าเพิ่มเรียบร้อยแล้ว!";
        $_SESSION['success'] = true;
        header("Location: {$base_url}/admin/manage_product.php");
        exit();
    } else {
        $_SESSION['message'] = "เกิดข้อผิดพลาดในการเพิ่มสินค้า: " . mysqli_error($conn);
        $_SESSION['success'] = false;
        header("Location: {$base_url}/admin/add_product.php");
        exit();
    }

    mysqli_close($conn);
}
