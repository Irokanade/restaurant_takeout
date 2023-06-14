<!DOCTYPE html>
<html>
<head>
    <title>所有餐廳報表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;    
        }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
    
        .topnav {
            overflow: hidden;
            background-color: #333;
        }
    
        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
    
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }
    
        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>

    <div class="topnav">
        <a class="active" href="">所有餐廳菜單累計數量報表</a>
    </div>

    <?php
    include("config.php");

    // Retrieve all restaurants
    $sql = "SELECT * FROM restaurant";
    $result = $conn->query($sql);

    $restaurants = array();

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['rest_id'];
            $restaurant_name = $row['rest_name'];

            $restaurants[$restaurant_id] = $restaurant_name;
        }
    }

    // Check if a specific restaurant is selected
    $selected_restaurant_id = isset($_GET['restaurant']) ? $_GET['restaurant'] : null;

    $menu_quantities = array();

    if ($selected_restaurant_id) {
        $sql = "SELECT menu_id, COUNT(*) AS total_quantity FROM order_items WHERE menu_id IN (SELECT menu_id FROM restaurant_menu WHERE rest_id = $selected_restaurant_id) GROUP BY menu_id";
    } else {
        $sql = "SELECT menu_id, COUNT(*) AS total_quantity FROM order_items GROUP BY menu_id";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $menu_id = $row['menu_id'];
            $total_quantity = $row['total_quantity'];

            $menu_quantities[$menu_id] = $total_quantity;
        }
    }

    // Retrieve menu information
    if ($selected_restaurant_id) {
        $sql = "SELECT menu.menu_id, menu.food_name, menu.food_price, menu.food_description, restaurant.rest_name, restaurant.rest_id
                FROM menu
                INNER JOIN restaurant_menu ON menu.menu_id = restaurant_menu.menu_id
                INNER JOIN restaurant ON restaurant_menu.rest_id = restaurant.rest_id
                WHERE restaurant_menu.rest_id = $selected_restaurant_id";
    } else {
        $sql = "SELECT menu.menu_id, menu.food_name, menu.food_price, menu.food_description, restaurant.rest_name, restaurant.rest_id
                FROM menu
                INNER JOIN restaurant_menu ON menu.menu_id = restaurant_menu.menu_id
                INNER JOIN restaurant ON restaurant_menu.rest_id = restaurant.rest_id";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>所有餐廳報表</h1>";
        echo "<form method='get'>";
        echo "<label for='restaurant'>選擇餐廳:</label>";
        echo "<select name='restaurant' id='restaurant'>";
        echo "<option value=''>所有餐廳</option>";

        foreach ($restaurants as $id => $name) {
            $selected = ($selected_restaurant_id == $id) ? 'selected' : '';
            echo "<option value='$id' $selected>$name</option>";
        }

        echo "</select>";
        echo "<button type='submit'>查詢</button>";
        echo "</form>";
        echo "<table class='table table-striped table-hover'>";
        echo "<tr><th>ID</th><th>菜名</th><th>價格</th><th>描述</th><th>累計數量</th><th>總金額</th><th>餐廳</th></tr>";

        $total_amount = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $menu_id = $row['menu_id'];
            $food_name = $row['food_name'];
            $food_price = $row['food_price'];
            $food_description = $row['food_description'];
            $rest_name = $row['rest_name'];
            $total_quantity = isset($menu_quantities[$menu_id]) ? $menu_quantities[$menu_id] : 0;
            $subtotal = $food_price * $total_quantity;
            $total_amount += $subtotal;

            echo "<tr>";
            echo "<td>$menu_id</td>";
            echo "<td>$food_name</td>";
            echo "<td>$food_price</td>";
            echo "<td>$food_description</td>";
            echo "<td>$total_quantity</td>";
            echo "<td>$subtotal</td>";
            echo "<td>$rest_name</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='6' align='right'><strong>總金額:</strong></td><td>$total_amount</td></tr>";

        echo "</table>";
    } else {
        echo "<h1>所有餐廳報表</h1>";
        echo "<form method='get'>";
        echo "<label for='restaurant'>選擇餐廳:</label>";
        echo "<select name='restaurant' id='restaurant'>";
        echo "<option value=''>所有餐廳</option>";

        foreach ($restaurants as $id => $name) {
            $selected = ($selected_restaurant_id == $id) ? 'selected' : '';
            echo "<option value='$id' $selected>$name</option>";
        }

        echo "</select>";
        echo "<button type='submit'>查詢</button>";
        echo "</form>";
        echo "<table class='table table-striped table-hover'>";

        $total_amount = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $menu_id = $row['menu_id'];
            $food_name = $row['food_name'];
            $food_price = $row['food_price'];
            $food_description = $row['food_description'];
            $rest_name = $row['rest_name'];
            $total_quantity = isset($menu_quantities[$menu_id]) ? $menu_quantities[$menu_id] : 0;
            $subtotal = $food_price * $total_quantity;
            $total_amount += $subtotal;

            echo "<tr>";
            echo "<td>$menu_id</td>";
            echo "<td>$food_name</td>";
            echo "<td>$food_price</td>";
            echo "<td>$food_description</td>";
            echo "<td>$total_quantity</td>";
            echo "<td>$subtotal</td>";
            echo "<td>$rest_name</td>";
            echo "</tr>";
            
        }
        echo "<p>No results found.</p>";
      

        echo "</table>";
    }

    $conn->close();
    ?>
    <input value='Print' type='button' onclick='handlePrint()' />
    <script type="text/javascript">
        const handlePrint = () => {
        var actContents = document.body.innerHTML;
        document.body.innerHTML = actContents;
        window.print();
        }
    </script>
</body>