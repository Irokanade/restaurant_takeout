<?php
include('session.php');
include("config.php");
?>

<?php include('r_navbar.php'); ?>

<html>
<head>
    <title>餐廳自取外賣平台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body {
            margin: 0;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        .jumbotron {
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background-color: #E9ECF2;
            border-radius: .3rem;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        .welcome {
            text-align: center;
            margin-top: 20px;
        }
        .jumbotron {
            padding: 4rem 2rem;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<Marquee Direction="Right" BGColor="gray">歡迎使用餐廳自取外賣平台</Marquee>
<div class="jumbotron">
    <div class="container">
    <h1 class="display-3">Welcome <?php
    $sql = "SELECT user_name FROM login_cred WHERE login_id = '$login_session'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $user_name = $row["user_name"];
        echo $user_name;
    }
    ?></h1>
    </div>
</div>


<h1 align="center">餐廳自取外賣平台</h1>
<table class="table table-striped table-hover" style="width: 60%" align="center">
    <tr>
        <th>Name</th>
        <th>Telephone Number</th>
        <th>Address</th>
        <th>Description</th>
        <th>Operating Hours</th>
    </tr>

    <!-- PHP code to retrieve and display data from the database -->

    <?php

    // Retrieve data for the current restaurant
    $sql = "SELECT * FROM restaurant INNER JOIN rest_login_cred ON restaurant.rest_id = rest_login_cred.rest_id WHERE rest_login_cred.login_id = '$login_session'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo '<td><a href="r_menu.php?rest_id=' . $row["rest_id"] . '">' . $row["rest_name"] . "</td>";
            echo "<td>" . $row["rest_telp_num"] . "</td>";
            echo "<td>" . $row["rest_address"] . "</td>";
            echo "<td>" . $row["rest_description"] . "</td>";
            echo "<td>" . $row["rest_open_status"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
    }

    $conn->close();
    ?>
    
</table>

</body>
</html>
