<?php
include("config.php");
?>

<html>
<head>
    <title>餐廳自取外賣平台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    .topnav .right {
        float: right;
    }

</style>
<body>

<div class="topnav">
    <a class="active" href="index.php">餐廳自取外賣平台</a>
    <a href="index.php#rest">餐廳選項</a>
    <div class="right">
        <a href="login.php">登入</a>
    </div>
</div>

<div>
    <a href="javascript:history.back()" class="btn btn-primary mx-3 my-2">❮ 上一頁</a>
</div>


<?php
$rest_id = $_GET['rest_id'];

// Retrieve data from the restaurant table
$sql = "SELECT * FROM restaurant WHERE rest_id = '$rest_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-6 mx-auto">
                    <h2 class="text-center">' . $row["rest_name"] . '</h2>
                    <p class="lead text-body-secondary">' . $row["rest_description"] . '</p>
                    <p class="text-body-secondary">Address: <a href="https://www.google.com/maps/search/' . urlencode($row["rest_address"]) . '" target="_blank">' . $row["rest_address"] . '</a></p>
                    <p class="text-body-secondary">Operating Hours: ' . $row["rest_open_status"] . '</p>
                    <p class="text-body-secondary">Phone Number: ' . $row["rest_telp_num"] . '</p>
                </div>
            </div>
        </div>';
    }
} else {
    echo "<p>No results found.</p>";
}
?>
<h1 class="text-center">菜單</h1>

<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">

        <!-- PHP code to retrieve and display data from the database -->

        <?php

        // Retrieve data from the menu table
        $sql = "SELECT * FROM menu WHERE menu_id IN (SELECT menu_id FROM restaurant_menu WHERE rest_id = '$rest_id')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="photo/pizza.jpg" class="bd-placeholder-img card-img-top" width="100%" height="225">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["food_name"] . '</h5>
                            <p class="card-text">' . $row["food_description"] . '</p>
                            <p class="card-text">Price: ' . $row["food_price"] . '</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No results found.</p>";
        }

        $conn->close();
        ?>

    </div>
</div>
<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
