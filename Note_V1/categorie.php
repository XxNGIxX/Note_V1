<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // เพิ่ม
    if(isset($_POST['name'])){
        $name = $_POST['name'];

        $check_sql = "SELECT * FROM categories WHERE name = '" . $name . "'";
        $rs_check = mysqli_query($conn, $check_sql);
        $check_num_rows = mysqli_num_rows($rs_check);

        if ($check_num_rows > 0) {
            echo "Cannot delete category as it is in use.";
        } else {
            // เพิ่ม
            $add_sql = "INSERT INTO categories (name) VALUES ('$name')";
            $rs_add = mysqli_query($conn, $add_sql);
          
        }  
        
    

       
    }

    // ลบ
    if(isset($_POST['category_id'])){
        $category_id = $_POST['category_id'];

        
        $check_sql = "SELECT * FROM transactions WHERE category_id = '" . $category_id . "'";
        $rs_check = mysqli_query($conn, $check_sql);
        $check_num_rows = mysqli_num_rows($rs_check);
    

        if ($check_num_rows > 0) {
            echo "Cannot delete category as it is in use.";
        } else {
            // ลบหมวดหมู่
            $del_sql = "DELETE FROM categories WHERE id = '" . $category_id . "'";
            $rs_del = mysqli_query($conn, $del_sql);
           
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">เพิ่มหมวดหมู่</a>
    </nav>

    <div class="card mt-4">
       
    <div class="card">
        <div class="card-body">
            

            <form action="" method="POST">
                

                <div class="form-group">
                    <label for="amount">ชื่อหมวดหมู่</label>
                    <input type="text" class="form-control" id="amount" name="name" placeholder="ชื่อหมวดหมู่" required>
                </div>


                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-save"></i> เพิ่มหมวดหมู่
                    
                </button>



            </form>
        </div>
    </div>
</div>

<div class="container form-container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ลบหมวดหมู่</a>
    </nav>

    <div class="card mt-4">
       
    <div class="card">
        <div class="card-body">
            

            <form action="" method="POST">
                

               
                <div class="form-group">
                    <label for="account">เลื่อกหมวดหมู่</label>
                    <div class="input-group">
                        <select id="account" name="category_id" class="form-control" required>
                            <?php
                                include 'db.php';
                                $shw = "SELECT * FROM categories";
                                $rs_shw = mysqli_query($conn, $shw);
                                while ($row = mysqli_fetch_assoc($rs_shw)) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                }
                            ?>
                        </select>
                    
                        
                    
                    </div>
                </div>



                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-save"></i> ลบหมวดหมู่
                    
                </button>



            </form>
        </div>
    </div>
</div>

<!--5555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555-->


            


</body>
</html>