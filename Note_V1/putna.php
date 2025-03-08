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

<div class="container">
    <h2 class="text-center mt-4">ผู้พัฒนา</h2>
    <div class="row justify-content-center">

        <!-- Developer 1 -->
        <div class="col-md-4 text-center developer-card">
            <img src="putna0001.png" alt="Developer 1" class="developer-image">
            <h4 class="mt-3">นาย นัสรูน นะจ๊ะ</h4>
            <p>บทบาท: นักเเสดง/นักร้อง เเละ ผู้รับผิดชอบด้านเก</p>
            <p>ความถนัด: เก, ผู้ชาย, หูรูด, ร้องเพลง</p>
        </div>

        <!-- Developer 2 -->
        <div class="col-md-4 text-center developer-card">
            <img src="putna0002.jpg" alt="Developer 2" class="developer-image">
            <h4 class="mt-3">ต่อ น้องเเตน</h4>
            <p>บทบาท: ฝ่ายตัดต่อ เเละ ตัดเเตน</p>
            <p>ความถนัด: กางเกง, หัวตัดเเละอีกมากมาย</p>
        </div>

        <!-- Developer 3 -->
        <div class="col-md-4 text-center developer-card">
            <img src="putna0003.png" alt="Developer 3" class="developer-image">
            <h4 class="mt-3">อัสดง คงมาด</h4>
            <p>บทบาท: ฝ่ายผลิตน้ำ เเละ บริการทางน้ำ</p>
            <p>ความถนัด: ถนัดขวา, อาจใช้ซ้ายในบางครั้งม มีความเชี้ยวชาญทางน้ำ</p>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
