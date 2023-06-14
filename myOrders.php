<?php
    include('sessionCustomer.php');
    include("config.php");
    $sql = "SELECT cust_id FROM cust_login_cred WHERE login_id = '$login_session'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $cust_id = $row["cust_id"];
    }
?>
<?php include('navbar.php'); ?>

<html>
<head>
	<title>My Orders</title>
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
<body bgcolor="#CEE9F3">
<h1 align="center"><?php $sql = "SELECT user_name FROM login_cred WHERE login_id = '$login_session'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $user_name = $row["user_name"];
                        echo $user_name;
                    }?> orders</h1>
<table style="width:50%" align="center">
	<tr>
		<th>ID</th>
		<th>Order Cost</th>
		<th>Order Status</th>
		<th>Pickup Time</th>
	</tr>

	<?php
		// Retrieve data from the menu table
		$sql = "SELECT * FROM `order` WHERE `order_id` IN (SELECT `order_id` FROM `cust_order` WHERE `cust_id` = '$cust_id')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td><a href='orderItems.php?order_id=".$row["order_id"]."'>" . $row["order_id"] . "</a></td>";
                echo "<td>".$row["order_total_cost"]."</td>";
                echo "<td>".$row["order_status"]."</td>";
                echo "<td>".$row["pickup_time"]."</td>";
                // echo "<td><a href='update.php?id=".$row["order_id"]."'>Modify</a></td>";
                // echo "<td><a href='delete.php?id=".$row["order_id"]."'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }

        $conn->close();
	?>

</table>
<!-- <p align="center"><a href="create.html">Add Data</a></p> -->
</body>
</html>
