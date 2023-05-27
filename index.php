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
	th, td {
		padding: 5px;
		text-align: left;
	}
</style>
<body>

<h1 align="center">餐廳自取外賣平台</h1>
<table style="width:50%" align="center">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Telephone Number</th>
		<th>Address</th>
		<th>Description</th>
		<th>Operating Hours</th>
		<th colspan="2">Action</th>
	</tr>

	<!-- PHP code to retrieve and display data from the database -->

	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "restaurant_takeout_db";

		// Connect to MySQL server
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Set up character set
		if (!$conn->set_charset("utf8")) {
			printf("Error loading character set utf8: %s\n", $conn->error);
			exit();
		}

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Retrieve data from the restaurant table
		$sql = "SELECT * FROM restaurant";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row["rest_id"]."</td>";
				echo "<td>".$row["rest_name"]."</td>";
				echo "<td>".$row["rest_telp_num"]."</td>";
				echo "<td>".$row["rest_address"]."</td>";
				echo "<td>".$row["rest_description"]."</td>";
				echo "<td>".$row["rest_open_status"]."</td>";
				echo "<td><a href='update.php?id=".$row["rest_id"]."'>Modify</a></td>";
				echo "<td><a href='delete.php?id=".$row["rest_id"]."'>Delete</a></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='7'>0 results</td></tr>";
		}

		$conn->close();
	?>

</table>
<p align="center"><a href="create.html">Add Data</a></p>
</body>
</html>
