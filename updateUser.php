<style>
body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    	background: #679D6B;
    }
h1{
    font-size: 40px;
    margin-left: 50px;
    font-family:'Lucida Sans' ;
	font-weight: bold;
    text-align: center;
}
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
.display-middle{position:absolute;top:40%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%)}
</style>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update</title>
</head>

<body>
<h1 align="center">Update User Information</h1>
	<form action="doupdateUser.php" method="post">	
	  <table width="500" border="1" bgcolor="#cccccc" align="center">
		<?php
		include('sessionAdmin.php');
		include("config.php");
			
		$id = $_GET['id'];
		$sql = "SELECT `user_name`, `user_password`, `user_email`, `user_type` FROM login_cred WHERE `login_id` = $id"; //set up your sql query
        $result = $conn->query($sql);	// Send SQL Query
		$row = mysqli_fetch_array ( $result, MYSQLI_ASSOC);
			
		//readonly ID
		echo '<tr>';
		echo '<th>User ID</th>';
		echo '<td bgcolor="#FFFFFF"><input type="text" name="login_id" value="' .$id. '" readonly/></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Username</th>';
		echo '<td bgcolor="#FFFFFF"><input type="text" name="user_name" value="' .$row['user_name']. '" /></td>';
		echo '</tr>';
			
		echo '<tr>';
		echo '<th>Password</th>';
		echo '<td bgcolor="#FFFFFF"><input type="text" name="user_password" value="' .$row['user_password']. '" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th>Email</th>';
		echo '<td bgcolor="#FFFFFF"><input type="text" name="user_email" value="' .$row['user_email']. '" /></td>';
		echo '</tr>';
			
		echo '<tr>';
		echo '<th>Type</th>';
		if ($row['user_type'] == "restaurant") { 
			echo '<td bgcolor="#FFFFFF"><input type="radio" name="user_type" value="customer">customer </input> <input type="radio" name="user_type" value="restaurant" checked>restaurant </input></td>';
		}
		else {
			echo '<td bgcolor="#FFFFFF"><input type="radio" name="user_type" value="customer" checked>customer </input> <input type="radio" name="user_type" value="restaurant">restaurant </input></td>';
		}
		echo '</tr>';
			
		echo '<tr>';
		echo '<th colspan="2"><input type="submit" value="update"/></th>';
		echo '</tr>';

		//pass the id to doupdate.php
		echo '<input type="hidden" name="login_id" value="' .$id. '" />';

		?>
	  </table>
	</form>
</body>
</html>