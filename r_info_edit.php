<?php
include('session.php');
include("config.php");

// 检查是否提交了表单
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rest_id = $_POST["rest_id"];
    $rest_telp_num = $_POST["rest_telp_num"];
    $rest_address = $_POST["rest_address"];
    $rest_description = $_POST["rest_description"];
    $rest_open_status = $_POST["rest_open_status"];
    $rest_name = $_POST["rest_name"];

    // 更新数据库中的餐厅信息
    $sql = "UPDATE restaurant SET
            rest_telp_num = '$rest_telp_num',
            rest_address = '$rest_address',
            rest_description = '$rest_description',
            rest_open_status = '$rest_open_status',
            rest_name = '$rest_name'
            WHERE rest_id = '$rest_id'";

    if ($conn->query($sql) === TRUE) {
        echo "餐廳信息已成功更新";
    } else {
        echo "更新餐廳信息時出錯：" . $conn->error;
    }
}

// 获取当前餐厅信息
$sql = "SELECT * FROM restaurant WHERE rest_id = '$login_session'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$conn->close();
?>

<?php include('r_navbar.php'); ?>

<html>
<head>
    <title>修改餐廳信息</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        
        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: 300px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #5085C4;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>修改餐廳信息</h1>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="rest_id" value="<?php echo $row['rest_id']; ?>">

    <label for="rest_telp_num">Telephone Number:</label>
    <input type="text" name="rest_telp_num" value="<?php echo $row['rest_telp_num']; ?>"><br>

    <label for="rest_address">Address:</label>
    <input type="text" name="rest_address" value="<?php echo $row['rest_address']; ?>"><br>

    <label for="rest_description">Description:</label>
    <textarea name="rest_description"><?php echo $row['rest_description']; ?></textarea><br>

    <label for="rest_open_status">Operating Hours:</label>
    <input type="text" name="rest_open_status" value="<?php echo $row['rest_open_status']; ?>"><br>

    <label for="rest_name">Name:</label>
    <input type="text" name="rest_name" value="<?php echo $row['rest_name']; ?>"><br>

    <input type="submit" value="更新">
</form>

</body>
</html>
