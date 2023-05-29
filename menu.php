<?php
    include('session.php');
    include("config.php");
    $rest_id = $_GET['rest_id'];
?>
<?php include('navbar.php'); ?>

<html>
<head>
	<title>menu</title>
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
<h1 align="center"><?php $sql = "SELECT rest_name FROM restaurant WHERE rest_id = '$rest_id'";
		                $result = $conn->query($sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if ($result->num_rows > 0) {
                            echo $row["rest_name"];
                        }
                        ?></h1>
<table style="width:50%" align="center">
	<tr>
		<th>ID</th>
		<th>Food Name</th>
		<th>Food Price</th>
		<th>Food Description</th>
		<th colspan="2">Action</th>
	</tr>

	<?php
		// Retrieve data from the menu table
		$sql = "SELECT * FROM menu WHERE menu_id IN (SELECT menu_id FROM restaurant_menu WHERE rest_id = '$rest_id')";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row["menu_id"]."</td>";
				echo "<td>".$row["food_name"]."</td>";
				echo "<td>".$row["food_price"]."</td>";
				echo "<td>".$row["food_description"]."</td>";
				echo "<td><a href='update.php?id=".$row["rest_id"]."'>Modify</a></td>";
				echo "<td><a href='delete.php?id=".$row["rest_id"]."'>Delete</a></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='6'>0 results</td></tr>";
		}

		$conn->close();
	?>

</table>
<p align="center"><a href="create.html">Add Data</a></p>
</body>
</html>
