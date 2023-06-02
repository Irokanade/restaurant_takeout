<?php
    include('session.php');
    include('config.php');
    
    // 獲取特定餐廳的菜單項目
    $rest_id = 1; // 替換為你想顯示菜單的餐廳 ID
    $sql = "SELECT m.menu_id, m.food_name, m.food_price, m.food_description
            FROM menu m
            INNER JOIN restaurant_menu rm ON m.menu_id = rm.menu_id
            WHERE rm.rest_id = $rest_id";
    $result = $conn->query($sql);
?>

<?php include('navbar.php'); ?>

<html>
<head>
    <title>Restaurant Menu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }
</style>
<body>
    <h1 align="center">Restaurant Menu</h1>
    <table style="width:50%" align="center">
        <tr>
            <th>ID</th>
            <th>Food Name</th>
            <th>Food Price</th>
            <th>Food Description</th>
        </tr>

        <?php
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["menu_id"] . "</td>";
                    echo "<td>" . $row["food_name"] . "</td>";
                    echo "<td>" . $row["food_price"] . "</td>";
                    echo "<td>" . $row["food_description"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No menu items found</td></tr>";
            }

            $conn->close();
        ?>

    </table>
</body>
</html>
