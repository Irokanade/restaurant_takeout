<?php
    include('sessionCustomer.php');
    include("config.php");
    $img_id = $_GET['image_id'];
?>
<?php include('navbar.php'); ?>

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
   a {
           display: block;
           color: #000000;
           font-weight: bold;
           text-decoration: underline;
    }
	.image-container {
		display: flex;
		justify-content: center;
	}

	.image-container img {
		width: 300px;
		height: 300px;
		margin-right: 10px;
	}
	.image-container .image-label {
		text-align: center;
		font-weight: bold;
		margin-top: 10px;
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
		<!-- <th colspan="2">Action</th> -->
	</tr>

	<!-- PHP code to retrieve and display data from the database -->

	<?php
	if($img_id == 1){
    	$searchKeyword1 = '%Taipei%';
    	$searchKeyword2 = '%台北市%';
    	$searchKeyword3 = '%臺北市%';
    	$searchKeyword4 = '%新北市%';
    	$searchKeyword5 = '%New Taipei%';
		$sql = "SELECT * FROM restaurant WHERE rest_address LIKE '%" . $searchKeyword1 . "%'
		OR rest_address LIKE '%" . $searchKeyword2 . "%'
		OR rest_address LIKE '%" . $searchKeyword3 . "%'
		OR rest_address LIKE '%" . $searchKeyword4 . "%'
		OR rest_address LIKE '%" . $searchKeyword5 . "%'";
		
	} else if($img_id == 2){
		$searchKeyword1 = '%Kaohsiung%';
    	$searchKeyword2 = '%高雄市%';
		$sql = "SELECT * FROM restaurant WHERE rest_address LIKE '%" . $searchKeyword1 . "%'
		OR rest_address LIKE '%" . $searchKeyword2 . "%'";
	} else if($img_id == 3){
		$searchKeyword1 = '%Tainan%';
    	$searchKeyword2 = '%台南市%';
    	$searchKeyword3 = '%臺南市%';
		$sql = "SELECT * FROM restaurant WHERE rest_address LIKE '%" . $searchKeyword1 . "%'
		OR rest_address LIKE '%" . $searchKeyword2 . "%'
		OR rest_address LIKE '%" . $searchKeyword3 . "%'";
	} else if($img_id == 4){
		$searchKeyword1 = '%Taichung%';
    	$searchKeyword2 = '%台中市%';
		$sql = "SELECT * FROM restaurant WHERE rest_address LIKE '%" . $searchKeyword1 . "%'
		OR rest_address LIKE '%" . $searchKeyword2 . "%'";
	} else if($img_id == 5){
		$searchKeyword1 = '%Taoyuan%';
    	$searchKeyword2 = '%桃園市%';
		$sql = "SELECT * FROM restaurant WHERE rest_address LIKE '%" . $searchKeyword1 . "%'
		OR rest_address LIKE '%" . $searchKeyword2 . "%'";
	} else {
		$searchKeyword1 = '%Taipei%';
    	$searchKeyword2 = '%台北市%';
    	$searchKeyword3 = '%臺北市%';
    	$searchKeyword4 = '%新北市%';
    	$searchKeyword5 = '%New Taipei%';
    	$searchKeyword6 = '%Kaohsiung%';
    	$searchKeyword7 = '%高雄市%';
    	$searchKeyword8 = '%Tainan%';
    	$searchKeyword9 = '%台南市%';
    	$searchKeyword10 = '%臺南市%';
    	$searchKeyword11 = '%Taichung%';
    	$searchKeyword12 = '%台中市%';
    	$searchKeyword13 = '%Taoyuan%';
    	$searchKeyword14 = '%桃園市%';
    	$sql = "SELECT * FROM restaurant WHERE rest_address NOT LIKE '%" . $searchKeyword1 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword2 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword3 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword4 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword5 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword6 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword7 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword8 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword9 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword10 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword11 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword12 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword11 . "%'
		AND rest_address NOT LIKE '%" . $searchKeyword12 . "%'";
	} 
    
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
				// echo "<td><a href='update.php?id=".$row["rest_id"]."'>Modify</a></td>";
				// echo "<td><a href='delete.php?id=".$row["rest_id"]."'>Delete</a></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='7'>0 results</td></tr>";
		}

		$conn->close();
	?>


</table>
<center>
<br/>
<div class="image-container">
  <div>
  	<a href="city.php?image_id=1">
     <img src="Photo/A.jpeg" alt="Image A">
     <div class="image-label">Big Taipei Area</div>
    </a>
  </div>
  <div>
  	<a href="city.php?image_id=2">
     <img src="Photo/B.jpeg" alt="Image B">
     <div class="image-label">Kaohsiung</div>
    </a> 
  </div>
  <div>
  	<a href="city.php?image_id=3">
     <img src="Photo/C.jpeg" alt="Image C">
     <div class="image-label">Tainan</div>
    </a>
  </div>
</div>
<br/>
<div class="image-container">
      <div>
      	<a href="city.php?image_id=4">
         <img src="Photo/D.jpeg" alt="Image D">
         <div class="image-label">Taichung</div>
        </a>
      </div>
      <div>
      	<a href="city.php?image_id=5">
         <img src="Photo/E.jpeg" alt="Image E">
         <div class="image-label">Taoyuan</div>
        </a> 
      </div>
      <div>
      	<a href="city.php?image_id=6">
         <img src="Photo/F.jpeg" alt="Image F">
         <div class="image-label">Other</div>
        </a>
      </div>
   </div>
<center/>
<!-- <p align="center"><a href="create.html">Add Data</a></p> -->
</body>
</html>
