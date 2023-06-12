<?php
    include('sessionAdmin.php');
	include("config.php");
?>
<?php include('adminNavbar.php'); ?>

<html>
<head>
	<title>餐廳自取外賣平台</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td , p{
		padding: 5px;
		text-align: center;
		font-family:'Lucida Sans' ;
		font-weight: bold;
	}

</style>
<body>
<h1>Welcome Admin <?php
		$sql = "SELECT user_name FROM login_cred WHERE login_id = '$login_session'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$user_name = $row["user_name"];
			echo $user_name;
		}
		?></h1>
<h1 align="center">User List</h1>
<table style="width:50%" align="center">
	<tr>
		<th>User ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Type</th>
	</tr>

	<!-- PHP code to retrieve and display data from the database -->

	<?php

		// Retrieve data from the restaurant table
		$sql = "SELECT * FROM login_cred";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row["login_id"]."</td>";
				//echo '<td><a href="myCart.php?rest_id='.$row["cust_id"] . '">' . $row["cust_id"] . '</a></td>';
				echo "<td>".$row["user_name"]."</td>";
				echo "<td>".$row["user_email"]."</td>";
				echo "<td>".$row["user_type"]."</td>";
				echo "<td><p><a href='updateUser.php?id=".$row["login_id"]."'>Modify</a></p><p><a href='deleteUser.php?id=".$row["login_id"]."'>Delete</a></p></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='7'>0 results</td></tr>";
		}

		$conn->close();
	?>

</table>
<p align="center"><a href="add.html">Add Data</a></p>
</body>
</html>