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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

<div class="topnav">
    <a class="active" href="index.php">餐廳自取外賣平台</a>
    <a href="#rest">餐廳選項</a>
    <div class="right">
        <a href="login.php">登入</a>
    </div>
</div>
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">餐廳自取外賣平台</h1>
        <p class="lead text-body-secondary">餐廳自取外賣平台是一個方便快捷的線上平台，讓用戶可以輕鬆地在餐廳菜單中選擇並訂購自己喜歡的外賣美食，並選擇自取的方式取餐。</p>
        <p class="lead text-body-secondary">無論是工作日的快速午餐還是週末的家庭聚餐，這個平台都能為您提供多樣化的餐點選擇，讓您享受美食的同時節省時間和精力。</p>
        <p>
          <a href="signup.php" class="btn btn-primary my-2">註冊</a>
          <a href="login.php" class="btn btn-secondary my-2">立刻訂餐</a>
        </p>
      </div>
    </div>
</section>
<div id="rest">
    <h1 class="text-center">餐廳選項</h1>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">


            <?php

            $sql = "SELECT * FROM restaurant";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="photo/rest.jpg" class="bd-placeholder-img card-img-top" width="100%" height="225">
                            <div class="card-body">
                                <h5 class="card-title">' . $row["rest_name"] . '</h5>
                                <p class="card-text">' . $row["rest_description"] . '</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="c_view_menu.php?rest_id=' . $row["rest_id"] . '" class="btn btn-sm btn-outline-secondary">View</a>
                                    </div>
                                    <small class="text-body-secondary">' . $row["rest_open_status"] . '</small>
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
</div>
<div class="divider"></div>

<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
