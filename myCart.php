<script>
    function confirmDelete() {
        var confirmed = confirm('Are you sure you want to delete?');
        document.getElementById('confirm_delete').value = confirmed ? '1' : '0';
        return confirmed;
    }
</script>

<?php
    include('sessionCustomer.php');
    include("config.php");
    $sql = "SELECT cust_id FROM cust_login_cred WHERE login_id = '$login_session'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $cust_id = $row["cust_id"];
    }
    $orderPlaced = $_SESSION['orderPlaced'];
    $order_id = $_SESSION['orderPlaced'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $menu_id = $_POST["menu_id"];
        $food_price = $_POST["food_price"];
        $confirm = $_POST["confirm_delete"];

        if ($confirm === "1") {
            $sql = "DELETE FROM order_items WHERE menu_id = $menu_id AND order_id = $order_id LIMIT 1";
            $conn->query($sql);

            $sql = "UPDATE `order` SET `order_total_cost` = `order_total_cost` - '$food_price' WHERE `order_id` = '$order_id'";
            $conn->query($sql);
        }
    }
?>
<?php include('navbar.php'); ?>

<html>
<head>
    <title>My Cart</title>
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
    $sql = "SELECT user_name FROM login_cred WHERE login_id = '$login_session'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $user_name = $row["user_name"];
        echo $user_name;
    }
    ?> Cart</h1>
<table style="width:50%" align="center">
    <tr>
        <th>ID</th>
        <th>Food Name</th>
        <th>Food Price</th>
        <th>Food Description</th>
        <th>Edit</th>
    </tr>

    <?php
    // Retrieve menu items from the menu table associated with the order ID
    $sql = "SELECT oi.menu_id, m.food_name, m.food_price, m.food_description
                FROM order_items oi
                INNER JOIN menu m ON oi.menu_id = m.menu_id
                WHERE oi.order_id = '$order_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["menu_id"] . "</td>";
            echo "<td>" . $row["food_name"] . "</td>";
            echo "<td>" . $row["food_price"] . "</td>";
            echo "<td>" . $row["food_description"] . "</td>";
            echo '<td>
                    <form method="post" onsubmit="return confirmDelete()">
                        <input type="hidden" name="menu_id" value="' . $row['menu_id'] . '" />
                        <input type="hidden" name="food_price" value="' . $row['food_price'] . '" />
                        <input type="hidden" name="confirm_delete" id="confirm_delete" value="0" />
                        <button type="submit">Delete</button>
                    </form>
                    </td>';        
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No order items found</td></tr>";
    }

    $conn->close();
    ?>

</table>
<p align="center">
    <a href="payment.php?order_id=<?php echo $order_id; ?>"><button type="button">Payment</button></a>
</p>
</body>
</html>



