<?php
    include 'db.php';
    $stmt = "SELECT * FROM categories";
    $rs_std = mysqli_query($conn, $stmt);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $transaction_id = $_POST['transaction_id'];
    
        // ลบรายการใน transactions
        $sql = "DELETE FROM transactions WHERE id = '" . $transaction_id . "'";
        $rs = mysqli_query($conn, $sql);
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">รายการสมุดบัญชี</a>
    </nav>

    <div class="card mt-4">
        
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>วัน/เวลา</th>
                <th>รายละเอียด</th>
                <th>จำนวนเงิน</th>
                <th>หมวดหมู่</th>
                <th>ประเภท</th>
                <th>การกระทำ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //*************************************************************************************************************************************** */
        $shw = "SELECT transactions.*, categories.name as category_name FROM transactions 
                 JOIN categories ON transactions.category_id = categories.id 
                 ORDER BY transactions.date_time DESC";//ใหม่ไปเก่า
        $rs_shw = mysqli_query($conn, $shw);
        //*************************************************************************************************************************************** */

        while ($row = mysqli_fetch_assoc($rs_shw)) {
            echo "<tr>";
            echo "<td>" . $row['date_time'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['category_name'] . "</td>";
            echo "<td>" . ucfirst($row['type']) . "</td>";
            echo "<td>
                    <form action='' method='POST' style='display:inline;'>
                        <input type='hidden' name='transaction_id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?\");'><i class='bi bi-trash-fill'> </i>ลบ</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
</div>
<!--5555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555-->
</body>
</html>
