<?php
    include('session.php');
    include("config.php");

$id = $_GET['id'];

if (isset($id)) {
    $delete_sql = "DELETE FROM restaurant WHERE rest_id = $id";

	if ($conn->query($delete_sql) === TRUE) {
        echo "Deleted!<a href='adminRestPage.php'>Back to Main page</a>";
    }else{
        echo "Failed to delete!";
	}

}else{
	echo "Incomplete information";
}
				
?>