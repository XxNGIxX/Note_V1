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
            echo "Category deleted successfully!";
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
            echo "Category deleted successfully!";
        }   
    }
    
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตัวติดตามรายรับ-รายจ่าย</title>
</head>
<body>
<h2>เพิ่มหมวดหมู่</h2>
    <form action="" method="POST">
        <input type="text"  name="name" placeholder="ชื่อหมวดหมู่" required><br>
        <button type="submit">เพิ่มหมวดหมู่</button>
    </form>
    
    <h2>ลบหมวดหมู่</h2>
    <form action="" method="POST">
        <select name="category_id">
            <?php
            include 'db.php';
            $shw = "SELECT * FROM categories";
            $rs_shw = mysqli_query($conn, $shw);
            while ($row = mysqli_fetch_assoc($rs_shw)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select><br>
        <button type="submit">ลบหมวดหมู่</button>
    </form>

</body>
</html>

