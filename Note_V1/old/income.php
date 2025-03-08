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
    <title>ตัวติดตามรายรับ-รายจ่าย</title>
</head>
<body>
    <h2>เพิ่มรายรับ</h2>
    <form action="" method="POST">
        <input type="datetime-local" name="date_time" required><br>
        <input type="text" name="description" placeholder="รายละเอียด" required><br>
        <input type="number" step="0.01" name="amount" placeholder="จำนวนเงิน" required><br>
        <select name="category_id">
            <?php
                include 'db.php';
                $stmt = "SELECT * FROM categories";
                $rs = mysqli_query($conn, $stmt);
                while ($row = mysqli_fetch_assoc($rs)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            ?>

            
        </select><br>
     
        <button type="submit">เพิ่มรายการ</button>
    </form>

</body>
</html>