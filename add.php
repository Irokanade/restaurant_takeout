<?php
 
	include('sessionAdmin.php');
	include("config.php");

	if (isset($_POST['user_name']) && isset($_POST['user_password']) && isset($_POST['user_email']) && isset($_POST['user_type'])) {
		$username = $_POST['user_name'];
		$userpass = $_POST['user_password'];
		$useremail = $_POST['user_email'];
		$usertype = $_POST['user_type'];
		
		$insert_sql = "INSERT INTO `login_cred` (`user_name`, `user_password`, `user_email`, `user_type`) VALUES ('$username', '$userpass', '$useremail', '$usertype')";
		
		if ($conn->query($insert_sql) === TRUE) {
			echo "Data added! <br> <a href='adminUsersPage.php'>Back to Main page</a>";
		} else {
			echo "<h2 align='center'><font color='antiquewith'>Failed to add!</font></h2>";
		}

	}else{
		echo "Incomplete Information";
	}

?>