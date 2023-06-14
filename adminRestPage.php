<style>
    body {
    background: #679D6B;
    }
</style>

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
	.tab {
        margin-left: 40px;
    }
	p{
        font-family:'Lucida Sans' ;
		font-weight: bold;
    }
	h1{
        font-family:'Lucida Sans' ;
		font-weight: bold;
    }

</style>
<body>
<h1 class="tab">Welcome Admin<?php
		$sql = "SELECT user_name FROM login_cred WHERE login_id = '$login_session'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$user_name = $row["user_name"];
		}
		?></h1>
<h1 align="center">Restaurant List</h1>
<table style="width:50%" align="center">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Telephone Number</th>
		<th>Address</th>
		<th>Description</th>
		<th>Operating Hours</th>
		<!-- <th colspan="2">Action</th> -->
	</tr>

	<!-- PHP code to retrieve and display data from the database -->

	<?php

		// Retrieve data from the restaurant table
		$sql = "SELECT * FROM restaurant";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<tr>";
				// echo "<td>".$row["rest_id"]."</td>";
				echo '<td><a href="menu.php?rest_id='.$row["rest_id"] . '">' . $row["rest_id"] . '</a></td>';
				echo "<td>".$row["rest_name"]."</td>";
				echo "<td>".$row["rest_telp_num"]."</td>";
				echo "<td>".$row["rest_address"]."</td>";
				echo "<td>".$row["rest_description"]."</td>";
				echo "<td>".$row["rest_open_status"]."</td>";
				//echo "<td><a href='update.php?id=".$row["rest_id"]."'>Modify</a></td>";
				echo "<td><a href='deleteRest.php?id=".$row["rest_id"]."'>Delete</a></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='7'>0 results</td></tr>";
		}

		$conn->close();
	?>

</table>
<p align="center"><a href="a_all_menu_report.php">View Menu Report</a></p>
</body>
</html>