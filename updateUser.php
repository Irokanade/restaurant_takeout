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
		include('session.php');
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