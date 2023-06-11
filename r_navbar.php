<?php
session_start();
include('session.php');
include('config.php');
?>

<style>
    nav {
        font-family: Arial, Helvetica, sans-serif;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        background-color: #5085C4;
        overflow: hidden;
    }

    nav li {
        float: left;
    }

    nav li a {
        display: block;
        color: #FFFFFF;
        font-weight: bold;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    nav li a:hover {
        background-color: #ddd;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;    
    }
    body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
    overflow: hidden;
    background-color: #333;
    }

    .topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    .topnav a:hover {
    background-color: #ddd;
    color: black;
    }

    .topnav a.active {
    background-color: #04AA6D;
    color: white;
    }
</style>
<div class="topnav">
    <a class="active" href="r_mainpage.php">餐廳自取外賣平台</a>
            <!-- Code for displaying restaurant information -->
        <?php
        // Retrieve data for the current restaurant
        $sql = "SELECT * FROM restaurant INNER JOIN rest_login_cred ON restaurant.rest_id = rest_login_cred.rest_id WHERE rest_login_cred.login_id = '$login_session'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $rest_id = $row["rest_id"];
            $rest_name = $row["rest_name"];

            // Display the restaurant name and link to the menu
            echo '<a href="r_menu.php?rest_id=' . $rest_id . '">' . $rest_name . '</a>';
            echo '<a href="r_menu.php?rest_id=' . $rest_id . '">' . 'Edit Menu'. '</a>';
        }
        ?>
    <a href="r_orders.php">Orders</a>
    <a href="r_info_edit.php<?php echo '?rest_id=' . $login_session; ?>">Edit Info</a>
    <?php
        if (isset($_SESSION['login_user'])) {
            $user_name = $_SESSION['login_user'];
            echo '<a href="userpage.php">Hi ' . $user_name . '</a>';
            echo '<a class="active" href="logout.php">Logout</a>';
        } else {
            echo '<a class="active" href="login.php">Login</a>';
        }
        ?>


    </div>

