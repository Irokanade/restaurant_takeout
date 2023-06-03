<?php
    include('session.php');
    include("config.php");
    $sql = "SELECT cust_id FROM cust_login_cred";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $cust_id = $row["cust_id"];
    }
    $order_id = $_GET['order_id'];
?>
<?php include('adminNavbar.php'); ?>

<html>
<head>
	<title>Order Items</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
        font-family:'Lucida Sans' ;
		font-weight: bold;
	}
	th, td {
		padding: 5px;
		text-align: left;
        font-family:'Lucida Sans' ;
		font-weight: bold;
	}
</style>
<body>
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
</body>
</html>