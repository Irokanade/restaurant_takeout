<style>
    body {
    background: #679D6B;
    }
</style>

<?php
    include('sessionAdmin.php');
    include("config.php");
    $sql = "SELECT cust_id FROM cust_login_cred";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $cust_id = $row["cust_id"];
    }
    $order_id = $_GET['order_id'];
?>

<html>
<head>
	<title>Order Items</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
	table, th, td {
		border: 2px solid black;
		border-collapse:collapse;
		background-color:cornsilk;
	}
	th, td {
		padding: 5px;
		text-align: left;
        font-family:'Lucida Sans' ;
		font-weight: bold;
	}
    p{
        font-family:'Lucida Sans' ;
		font-weight: bold;
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
        padding: 20px 16px;
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

<body>
<div class="topnav">
    <a class="active" href="adminMainPage.php">Home</a>
    <a class="active" href="adminOrdersPage.php">Back to order page</a>
</div>

<h1 align="center"><?php $sql = "SELECT cust_name FROM customer NATURAL JOIN cust_order WHERE order_id = '$order_id'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $user_name = $row["cust_name"];
                        echo $user_name;
                    }?> orders</h1>
<table style="width:50%" align="center">
    <tr>
        <th>ID</th>
        <th>Food Name</th>
        <th>Food Price</th>
        <th>Food Description</th>
    </tr>

    <?php
        // Retrieve data from the order_items and menu tables with order_id = $order_id
        $sql = "SELECT oi.menu_id, m.food_name, m.food_price, m.food_description
                FROM order_items oi
                INNER JOIN menu m ON oi.menu_id = m.menu_id
                WHERE oi.order_id = '$order_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["menu_id"]."</td>";
                echo "<td>".$row["food_name"]."</td>";
                echo "<td>".$row["food_price"]."</td>";
                echo "<td>".$row["food_description"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>0 results</td></tr>";
        }

        $conn->close();
    ?>

</table>
<p align="center"><a href="adminOrdersPage.php">Back to Order List</a></p>
</body>
</html>