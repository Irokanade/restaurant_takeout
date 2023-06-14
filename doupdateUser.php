<?php

include('sessionAdmin.php');
include("config.php");

if (isset($_POST['user_name']) && isset($_POST['user_password']) && isset($_POST['user_email']) && isset($_POST['user_type'])) {
	$id = $_POST['login_id'];
	$username = $_POST['user_name'];
	$userpass = $_POST['user_password'];
	$useremail = $_POST['user_email'];
	$usertype = $_POST['user_type'];

	$update_sql = "UPDATE `login_cred` SET `user_name`= '$username',`user_password`= '$userpass',`user_email`= '$useremail',`user_type`= '$usertype' WHERE `login_id` = '$id'"; 
	
	if ($conn->query($update_sql) === TRUE) {
		echo "Modified Successfully!<br> <a href='adminMainPage.php'>Back to Main page</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>Update failed!</font></h2>";
	}

}else{
	echo "Incomplete Information";
}
				
?>