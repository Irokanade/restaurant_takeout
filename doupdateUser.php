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
.display-middle{position:absolute;top:40%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%)}
</style>

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
		echo "<h1 class='display-middle'>Modified succesfully!<br> <a href='adminMainPage.php'>Back to Main page</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>Update failed!</font></h2>";
	}

}else{
	echo "Incomplete Information";
}
				
?>