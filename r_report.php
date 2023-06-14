<?php
include("config.php");
?>

<html>
<head>
    <title>Restaurant Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
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

    .container {
        margin-top: 20px;
    }

    .table-container {
        max-width: 800px;
        margin: 0 auto;
    }

</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

<?php include('r_navbar.php'); ?>

<div class="container">
    <div class="table-container">
        <?php
        $rest_id = $_GET['rest_id'];

        $sql = "SELECT menu_id, COUNT(*) AS total_quantity FROM order_items GROUP BY menu_id";
        $result = $conn->query($sql);

        $menu_quantities = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $menu_id = $row['menu_id'];
                $total_quantity = $row['total_quantity'];

                $menu_quantities[$menu_id] = $total_quantity;
            }
        }

        $sql = "SELECT menu.menu_id, menu.food_name, menu.food_price, menu.food_description, restaurant.rest_name, restaurant.rest_id
                FROM menu
                INNER JOIN restaurant_menu ON menu.menu_id = restaurant_menu.menu_id
                INNER JOIN restaurant ON restaurant_menu.rest_id = restaurant.rest_id
                WHERE restaurant.rest_id = '$rest_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1 class='text-center'>Restaurant Report</h1>";
            echo "<table class='table table-striped table-hover' >";
            echo "<tr><th>ID</th><th>Menu</th><th>Price</th><th>Describe</th><th>Cumulative Quantity</th><th>Amount of money</th><th>restaurant</th></tr>";
            //echo "<tr><th>菜單ID</th><th>菜名</th><th>價格</th><th>描述</th><th>累計數量</th><th>總金額</th></tr>";
            $total_amount = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $menu_id = $row['menu_id'];
                $food_name = $row['food_name'];
                $food_price = $row['food_price'];
                $food_description = $row['food_description'];
                $rest_name = $row['rest_name'];


                $quantity = isset($menu_quantities[$menu_id]) ? $menu_quantities[$menu_id] : 0;
                $total = $quantity * $food_price;
                $total_amount += $total;

                echo "<tr><td>$menu_id</td><td>$food_name</td><td>$food_price</td><td>$food_description</td><td>$quantity</td><td>$total</td><td>$rest_name</td></tr>";
            }

            echo "<tr><td colspan='5' class='text-end'> Amount of money：</td><td>$total_amount</td><td></td></tr>";

            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }

        $conn->close();
        ?>
    </div>
</div>
    <input value='Print' type='button' onclick='handlePrint()' />
    <script type="text/javascript">
        const handlePrint = () => {
        var actContents = document.body.innerHTML;
        document.body.innerHTML = actContents;
        window.print();
        }
    </script>
<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
