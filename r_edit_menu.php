<?php
    include('session.php');
    include('config.php');

    // 检查是否有提交表单
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 获取表单提交的菜单数据
        $menu_id = $_POST['menu_id'];
        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $food_description = $_POST['food_description'];

        // 更新菜单项的数据
        $update_sql = "UPDATE menu SET food_name='$food_name', food_price='$food_price', food_description='$food_description' WHERE menu_id='$menu_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "菜单项已成功更新！";
        } else {
            echo "错误：" . $conn->error;
        }
    }

    // 获取要修改的菜单项的ID
    $menu_id = $_GET['menu_id'];

    // 查询菜单项的数据
    $select_sql = "SELECT * FROM menu WHERE menu_id='$menu_id'";
    $result = $conn->query($select_sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // 提取检索到的数据
        $food_name = $row['food_name'];
        $food_price = $row['food_price'];
        $food_description = $row['food_description'];

        // 关闭结果集
        $result->close();
    } else {
        echo "未找到给定的菜单项";
        exit();
    }

    // 关闭数据库连接
    $conn->close();
?>

<?php include('navbar.php'); ?>

<html>
<head>
    <title>Edit Menu Item</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <h1 align="center">Edit Menu Item</h1>
    <form method="POST" action="">
        <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>">
        <table align="center">
            <tr>
                <td>Food Name:</td>
                <td><input type="text" name="food_name" value="<?php echo $food_name; ?>" required></td>
            </tr>
            <tr>
                <td>Food Price:</td>
                <td><input type="number" name="food_price" value="<?php echo $food_price; ?>" required></td>
            </tr>
            <tr>
                <td>Food Description:</td>
                <td><textarea name="food_description" rows="4" cols="50" required><?php echo $food_description; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update Menu">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
