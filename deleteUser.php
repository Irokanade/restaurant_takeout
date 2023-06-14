<?php
    include('sessionAdmin.php');
    include("config.php");

$id = $_GET['id'];

if (isset($id)) {
    $delete_sql = "DELETE FROM login_cred WHERE login_id = $id";

	if ($conn->query($delete_sql) === TRUE) {
        echo "Deleted!<a href='adminUserPage.php'>Back to Main page</a>";
    }else{
        echo "Failed to delete!";
	}

}else{
	echo "Incomplete information";
}
				
?>