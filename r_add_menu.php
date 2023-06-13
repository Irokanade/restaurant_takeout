<?php
    include('sessionRestaurant.php');
    include('config.php');

    // 检查是否有提交表单
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 获取表单提交的菜单数据
        $rest_id = $_POST['rest_id'];
        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $food_description = $_POST['food_description'];

        // 将菜单项插入到数据库
        $sql = "INSERT INTO menu (food_name, food_price, food_description) VALUES ('$food_name', '$food_price', '$food_description')";

        if ($conn->query($sql) === TRUE) {
            // 获取刚插入的菜单项的ID
            $menu_id = $conn->insert_id;

            // 将菜单项与餐厅关联
            $sql = "INSERT INTO restaurant_menu (rest_id, menu_id) VALUES ('$rest_id', '$menu_id')";
            if ($conn->query($sql) === TRUE) {
                echo "菜單項已成功添加！";
            } else {
                echo "錯誤：" . $conn->error;
            }
        } else {
            echo "錯誤：" . $conn->error;
        }
    }

    // 获取餐厅ID
    $rest_id = $_GET['rest_id'];

    // 关闭数据库连接
    $conn->close();
?>

<?php include('r_navbar.php'); ?>

<html>
<head>
    <title>Add Menu Item</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <h1 align="center">Add Menu Item</h1>
    <form method="POST" action="">
        <input type="hidden" name="rest_id" value="<?php echo $rest_id; ?>">
        <table align="center">
            <tr>
                <td>Food Name:</td>
                <td><input type="text" name="food_name" required></td>
            </tr>
            <tr>
                <td>Food Price:</td>
                <td><input type="number" name="food_price" required></td>
            </tr>
            <tr>
                <td>Food Description:</td>
                <td><textarea name="food_description" rows="4" cols="50" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Add Menu">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>