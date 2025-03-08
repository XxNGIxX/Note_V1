<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $category = isset($_POST['category_id']) ? $_POST['category_id'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';


    $type_all = $type ? "AND transactions.type = '$type'" : ""; // ถ้าไม่เลือก type จะแสดงทุกประเภท
    $category_all = $category ? "AND transactions.category_id = '$category'" : ""; // ถ้าไม่เลือกหมวดหมู่ จะแสดงทุกหมวดหมู่
    
    if ($start_date && $end_date) {
        //*************************************************************************************************************************************** 
        $query = "SELECT SUM(transactions.amount) AS total, DATE(transactions.date_time) AS period, categories.name AS category, transactions.type
                  FROM transactions
                  JOIN categories ON transactions.category_id = categories.id
                  WHERE DATE(transactions.date_time) BETWEEN '$start_date' AND '$end_date'
                  $type_all $category_all
                  GROUP BY period, category, transactions.type";
        //*************************************************************************************************************************************** 
        $rs_query = mysqli_query($conn, $query);

        $grand_income = 0;
        $grand_expense = 0;
        $result_rows = ""; // ใช้เพื่อเก็บผลลัพธ์ของแต่ละแถว

        // เก็บข้อมูลใน result_rows ถ้ามีข้อมูล
        while ($result = mysqli_fetch_assoc($rs_query)) {
            $result_rows .= "<tr>";
            $result_rows .= "<td>" . $result['period'] . "</td>";
            $result_rows .= "<td>" . $result['category'] . "</td>";
            $result_rows .= "<td>" . number_format($result['total'], 2) . "</td>";
            $result_rows .= "</tr>";

            // แยกยอดรวมของรายรับและรายจ่าย
            if ($result['type'] == 'income') {
                $grand_income += $result['total'];
            } else if ($result['type'] == 'expense') {
                $grand_expense += $result['total'];
            }
        }

        // ตรวจสอบว่ามีข้อมูลหรือไม่ ถ้ามีให้เพิ่มแถวสรุปยอดรวม
        if ($result_rows) {
            $net_total = $grand_income - $grand_expense; // รายรับลบรายจ่าย
            $result_rows .= "<tr class='font-weight-bold'>";
            $result_rows .= "<td colspan='2' class='text-right'>รวมรายรับ:</td>";
            $result_rows .= "<td>" . number_format($grand_income, 2) . "</td>";
            $result_rows .= "</tr>";

            $result_rows .= "<tr class='font-weight-bold'>";
            $result_rows .= "<td colspan='2' class='text-right'>รวมรายจ่าย:</td>";
            $result_rows .= "<td>" . number_format($grand_expense, 2) . "</td>";
            $result_rows .= "</tr>";

            $result_rows .= "<tr class='font-weight-bold'>";
            $result_rows .= "<td colspan='2' class='text-right'>สุทธิ (รายรับ - รายจ่าย):</td>";
            $result_rows .= "<td>" . number_format($net_total, 2) . "</td>";
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>ตัวติดตามรายรับ-รายจ่าย</title>
    <style>
        

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 15px;
            height: 100vh;
        }
        .sidebar a {
            color: #ffffff;
            padding: 10px;
            text-decoration: none;
            display: block;
        }
        
        body {
            display: flex;
        }
        .content {
            flex: 1;
            padding: 20px;
        }

        
    </style>
</head>
<body>

<div class="sidebar">

    <h2 class="text-light" >Dong Account</h2>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="home.php"><i class="bi bi-bank "> </i>รายการสมุดบัญชี</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="income.php"><i class="bi bi-caret-up-square"> </i>เพิ่มรายรับ</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="expense.php"><i class="bi bi-caret-down-square"> </i>เพิ่มรายจ่าย</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="categorie.php"><i class="bi bi-clipboard-plus"> </i>จัดการหมวดหมู่</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="summary.php"><i class="bi bi-cash-coin"> </i>สรุปรายการ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="putna.php">ผู้พัฒนา</a>
        </li>
    </ul>
</div>
<!--5555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555-->
<div class="container form-container">
    <div class="card">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">รายรับ</a>
        </nav>
        <div class="card-body">
            <form action="summary.php" method="post">
                <div class="form-group">
                    <label for="type">ประเภท:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">ทั้งหมด</option> <!-- ตัวเลือกสำหรับแสดงทั้งหมด -->
                        <option value="income">รายรับ</option>
                        <option value="expense">รายจ่าย</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">เลือกหมวดหมู่:</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">ทั้งหมด</option> <!-- ตัวเลือกสำหรับแสดงทุกหมวดหมู่ -->
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
<!--5555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555-->
    <div class="mt-4">
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
    </body>
</html>