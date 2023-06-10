<?php
    include('session.php');
    include("config.php");
    $rest_id = $_GET['rest_id'];
?>
<?php include('navbar.php'); ?>

<html>
<head>
    <title>Menu</title>
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
<body>
<h1 align="center"><?php
    $sql = "SELECT rest_name FROM restaurant WHERE rest_id = '$rest_id'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        echo $row["rest_name"];
    }
?></h1>
<table style="width:50%" align="center">
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
                echo "<td><a href='addToCartPage.php?menu_id=".$row["menu_id"]."'>".$row["menu_id"]."</a></td>";
                echo "<td>".$row["food_name"]."</td>";
                echo "<td>".$row["food_price"]."</td>";
                echo "<td>".$row["food_description"]."</td>";
                echo "<td>";
                echo "<a href='r_edit_menu.php?menu_id=".$row["menu_id"]."'>Edit</a>";
                echo " | ";
                echo "<a href='r_delete_menu.php?menu_id=".$row["menu_id"]."' onclick='return confirm(\"Are you sure you want to delete this menu item?\")'>Delete</a>";
                echo "</td>";
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
