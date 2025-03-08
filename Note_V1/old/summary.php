<?php
include 'db.php';

// ตรวจสอบการส่งค่าผ่าน POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

    if ($start_date && $end_date) {
        $query = "SELECT SUM(transactions.amount) AS total, DATE(transactions.date_time) AS period, categories.name AS category
                  FROM transactions
                  JOIN categories ON transactions.category_id = categories.id
                  WHERE transactions.type = '" . $type . "'
                  AND transactions.category_id = '" . $category . "'
                  AND DATE(transactions.date_time) BETWEEN '" . $start_date . "' AND '" . $end_date . "'
                  GROUP BY period, category";

        $rs_query = mysqli_query($conn, $query);

        $grand_total = 0;
        $result_rows = ""; // ใช้เพื่อเก็บผลลัพธ์ของแต่ละแถว

        // เก็บข้อมูลใน result_rows ถ้ามีข้อมูล
        while ($result = mysqli_fetch_assoc($rs_query)) {
            $result_rows .= "<tr>";
            $result_rows .= "<td>" . $result['period'] . "</td>";
            $result_rows .= "<td>" . $result['category'] . "</td>";
            $result_rows .= "<td>" . number_format($result['total'], 2) . "</td>";
            $result_rows .= "</tr>";
            $grand_total += $result['total'];
        }

        // ตรวจสอบว่ามีข้อมูลหรือไม่ ถ้ามีให้เพิ่มแถวสรุปยอดรวม
        if ($result_rows) {
            $result_rows .= "<tr class='font-weight-bold'>";
            $result_rows .= "<td colspan='2' class='text-right'>รวมทั้งหมด:</td>";
            $result_rows .= "<td>" . number_format($grand_total, 2) . "</td>";
            $result_rows .= "</tr>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตัวติดตามรายรับ-รายจ่าย</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            padding-top: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card">
        <div class="card-header text-center">
            <h2>สรุปผลรายรับ-รายจ่าย</h2>
        </div>
        <div class="card-body">
            <form action="summary.php" method="post">
                <div class="form-group">
                    <label for="type">ประเภท:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="income">รายรับ</option>
                        <option value="expense">รายจ่าย</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">เลือกหมวดหมู่:</label>
                    <select name="category_id" id="category" class="form-control">
                        <?php
                        $shw = "SELECT * FROM categories";
                        $rs_shw = mysqli_query($conn, $shw);
                        while ($row = mysqli_fetch_assoc($rs_shw)) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_date">วันที่เริ่มต้น:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="2024-09-25" required>
                </div>

                <div class="form-group">
                    <label for="end_date">วันที่สิ้นสุด:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="2024-09-25" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-chart-line"></i> แสดงผลสรุป
                </button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h3 class='text-center mb-4'>สรุปผลจาก 2024-09-25 ถึง 2024-09-25</h3>
        <table class='table table-bordered table-striped'>
            <thead class='thead-dark'>
            <tr>
                <th>วันที่</th>
                <th>หมวดหมู่</th>
                <th>ยอดรวม</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // แสดงผลลัพธ์ถ้ามีข้อมูล ถ้าไม่มีก็แสดงแถวว่าง
            echo isset($result_rows) && $result_rows ? $result_rows : "<tr><td colspan='3' class='text-center'>ไม่มีข้อมูล</td></tr>";
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
