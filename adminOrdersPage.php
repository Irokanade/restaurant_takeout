<?php
    include('session.php');
    include("config.php");
    $sql = "SELECT cust_id FROM cust_login_cred WHERE login_id = '$login_session'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $cust_id = $row["cust_id"];
    }
?>
<?php include('adminNavbar.php'); ?>

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
        font-family:'Lucida Sans' ;
		font-weight: bold;
	}
    h1 {
        text-align: center;
        font-family:'Lucida Sans' ;
		font-weight: bold;
    }
</style>
<body>
<h1> Order Lists </h1>
<table style="width:50%" align="center">
	<tr>
		<th>Order ID</th>
		<th>Customer Name</th>
	</tr>

	<?php
		// Retrieve data from the menu table
		$sql = "SELECT * FROM `customer` NATURAL JOIN `cust_order`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td><a href='adminOrderItems.php?order_id=".$row["order_id"]."'>" . $row["order_id"] . "</a></td>";
                echo "<td>".$row["cust_name"]."</td>";
                //echo "<td><p><a href='update.php?id=".$row["order_id"]."'>Modify</a></p><p><a href='delete.php?id=".$row["order_id"]."'>Delete</a></p></td>";
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