<<<<<<< HEAD
<?php
include('sessionAdmin.php');
include("config.php");
    $rest_id = $_GET['rest_id'];
?>

<html>
<head>
	<title>menu</title>
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
    	background: #679D6B;
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
    <a class="active" href="adminRestPage.php">Back to Rest page</a>
</div>

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
		<!-- <th colspan="2">Action</th> -->
	</tr>

	<?php
		// Retrieve data from the menu table
		$sql = "SELECT * FROM menu WHERE menu_id IN (SELECT menu_id FROM restaurant_menu WHERE rest_id = '$rest_id')";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row["menu_id"]."</a></td>";
				echo "<td>".$row["food_name"]."</td>";
				echo "<td>".$row["food_price"]."</td>";
				echo "<td>".$row["food_description"]."</td>";
				// echo "<td><a href='update.php?id=".$row["rest_id"]."'>Modify</a></td>";
				// echo "<td><a href='delete.php?id=".$row["rest_id"]."'>Delete</a></td>";
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
=======
<?php
    include('sessionAdmin.php');
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
<body bgcolor="#CEE9F3">
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
		<!-- <th colspan="2">Action</th> -->
	</tr>

	<?php
		// Retrieve data from the menu table
		$sql = "SELECT * FROM menu WHERE menu_id IN (SELECT menu_id FROM restaurant_menu WHERE rest_id = '$rest_id')";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>".$row["menu_id"]."</a></td>";
				echo "<td>".$row["food_name"]."</td>";
				echo "<td>".$row["food_price"]."</td>";
				echo "<td>".$row["food_description"]."</td>";
				// echo "<td><a href='update.php?id=".$row["rest_id"]."'>Modify</a></td>";
				// echo "<td><a href='delete.php?id=".$row["rest_id"]."'>Delete</a></td>";
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
>>>>>>> main
