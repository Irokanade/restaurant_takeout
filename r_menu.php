<?php
include('sessionRestaurant.php');
include("config.php");
$rest_id = $_GET['rest_id'];

if(isset($_POST['delete_menu_id'])){
    $delete_menu_id = $_POST['delete_menu_id'];
    // Delete menu from the menu table
    $delete_menu_sql = "DELETE FROM menu WHERE menu_id = '$delete_menu_id'";
    if($conn->query($delete_menu_sql) === TRUE) {
        // Delete menu from the restaurant_menu table
        $delete_restaurant_menu_sql = "DELETE FROM restaurant_menu WHERE menu_id = '$delete_menu_id' AND rest_id = '$rest_id'";
        if($conn->query($delete_restaurant_menu_sql) === TRUE){
            echo "菜單刪除成功。";
        } else {
            echo "從 restaurant_menu 表中刪除菜單時出錯： " . $conn->error;
        }
    } else {
        echo "從菜單表中刪除菜單時出錯： " . $conn->error;
    }
}

?>

<?php include('r_navbar.php'); ?>

<html>
<head>
    <title>餐廳菜單</title>
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

<h1 align="center"><?php
    $sql = "SELECT rest_name FROM restaurant WHERE rest_id = '$rest_id'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        echo $row["rest_name"];
    }
?></h1>
<table class="table table-striped table-hover" style="width:50%" align="center">
    <tr>
        <th>ID</th>
        <th>Food Name</th>
        <th>Food Price</th>
        <th>Food Description</th>
        <th>Action</th>
    </tr>

    <?php
        // Retrieve data from the menu table
        $sql = "SELECT * FROM menu WHERE menu_id IN (SELECT menu_id FROM restaurant_menu WHERE rest_id = '$rest_id')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["menu_id"]."</td>";
                echo "<td>".$row["food_name"]."</td>";
                echo "<td>".$row["food_price"]."</td>";
                echo "<td>".$row["food_description"]."</td>";
                echo "<td>
                        <a href='r_edit_menu.php?menu_id=".$row["menu_id"]."'>Edit</a>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_menu_id' value='".$row["menu_id"]."'>
							<font>|</font>
                            <button type='submit' style='background:none; border:none; color:red; cursor:pointer;'>Delete</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }

        $conn->close();
    ?>

</table>
<a href="r_add_menu.php?rest_id=<?php echo $rest_id; ?>" style="display: block; text-align: center; margin-top: 20px;">Add Menu</a>
</body>
</html>
