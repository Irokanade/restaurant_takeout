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

$id = $_GET['id'];

if (isset($id)) {
    $delete_sql = "DELETE FROM restaurant WHERE rest_id = $id";

	if ($conn->query($delete_sql) === TRUE) {
        echo "<h1 class='display-middle'>Deleted succesfully!<br><a href='adminRestPage.php'>Back to Main page</a>";
    }else{
        echo "Failed to delete!";
	}

}else{
	echo "Incomplete information";
}
				
?>