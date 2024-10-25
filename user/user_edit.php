<?php
include('partials/header.php');
?>


    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            min-height: 100vh;
            padding-top: 20px;
        }

        .sidebar a {
            color: #333;
            font-weight: bold;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #f5f5f5;
            color: red;
        }

        .user-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-edit {
            background-color: #f8d7da;
            color: red;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-edit:hover {
            background-color: #f5c2c7;
        }

        .status-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
        }

        .status-card p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .status-card span {
            display: block;
            font-size: 14px;
            color: #888;
        }

        .user-details {
            margin-top: 20px;
        }

        .user-details .detail-item {
            margin-bottom: 10px;
        }

        .user-details .detail-item span {
            color: #888;
        }
    </style>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <a href="#" class="active">ข้อมูลส่วนตัว</a>
                <a href="#">ที่อยู่สำหรับจัดส่ง</a>
                <a href="#">ที่อยู่สำหรับออกใบกำกับภาษี</a>
                <a href="#">ช่องทางชำระเงิน</a>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>ข้อมูลส่วนตัว</h4>
                    <button class="btn btn-edit">แก้ไขข้อมูลส่วนตัว</button>
                </div>

                <div class="user-info d-flex align-items-center">
                    <img src="https://via.placeholder.com/80" alt="User Image" class="rounded-circle me-3">
                    <div>
                        <h5>มาร์ค คคค</h5>
                        <p>lhwza007x2@gmail.com</p>
                    </div>
                </div>

                <div class="row text-center my-4">
                    <div class="col-md-4">
                        <div class="status-card">
                            <p>0</p>
                            <span>เสร็จสิ้น</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status-card">
                            <p>0</p>
                            <span>จัดส่งแล้ว</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status-card">
                            <p>0</p>
                            <span>รอดำเนินการ</span>
                        </div>
                    </div>
                </div>

                <div class="user-details">
                    <div class="row">
                        <div class="col-md-6 detail-item">
                            <strong>ชื่อ - นามสกุล:</strong> มาร์ค คคค
                        </div>
                        <div class="col-md-6 detail-item">
                            <strong>อีเมล:</strong> lhwza007x2@gmail.com
                        </div>
                        <div class="col-md-6 detail-item">
                            <strong>หมายเลขโทรศัพท์:</strong> -
                        </div>
                        <div class="col-md-6 detail-item">
                            <strong>วัน / เดือน / ปีเกิด:</strong> -
                        </div>
                        <div class="col-md-6 detail-item">
                            <strong>ไลน์ไอดี:</strong> -
                        </div>
                        <div class="col-md-6 detail-item">
                            <strong>เฟสบุ๊ก:</strong> -
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</
