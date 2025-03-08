<?php
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $date_time = $_POST['date_time'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $category_id = $_POST['category_id'];
        $type = "income";
    
        $sql = "INSERT INTO transactions(date_time, description, amount, category_id, type) VALUES('$date_time','$description ', '$amount', '$category_id','$type ')";
        $result = mysqli_query($conn, $sql);
        header('location:Home.php');

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
        .head {
            background-color: #343a40;
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
        <a class="navbar-brand " href="#">รายรับ</a>
    </nav>

    <div class="card mt-4">
       
    <div class="card">
        <div class="card-body">
            


            <form action="" method="POST">
                <div class="form-group">
                    <label for="account">หมวดหมู่</label>
                    <div class="input-group">
                        <select id="account" name="category_id" class="form-control" required>
                            <?php
                                include 'db.php';
                                $stmt = "SELECT * FROM categories";
                                $rs = mysqli_query($conn, $stmt);
                                while ($row = mysqli_fetch_assoc($rs)) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                }
                            ?>
                        </select>
                    
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button" ><a href="categorie.php" >+ เพิ่มหมวดหมู่</a></button>
                        </div>
                    
                    </div>
                </div>



                <div class="form-group">
                    <label for="amount">จำนวนเงิน</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="จำนวนเงิน" required>
                </div>



                <div class="form-group">
                    <label for="description">บันทึกย่อ</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="รายละเอียด">
                </div>


                
                <div class="form-group">
                    <label for="date">วันที่</label>
                    <div class="input-group">
                        <input type="datetime-local"  class="form-control" id="date" name="date_time" required >
                       
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-save"></i> บันทึก
                </button>



            </form>
        </div>
    </div>
</div>
<!--5555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555-->


</body>
</html>