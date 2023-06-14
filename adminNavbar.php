<?php
include('sessionAdmin.php');
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

    .topnav a.activeright {
        background-color: #04AA6D;
        color: white;
        float: right;
    }
    .topnav .active {
        background-color: #04AA6D;
        color: white;
    }

</style>
<div class="topnav">
    <a class="active" href="adminMainPage.php">Home</a>
    <a> Hi Admin </a>
    <?php
        if (isset($_SESSION['login_user'])) {
            $user_email = $_SESSION['login_user'];
            echo '<a class="activeright" href="logout.php">Logout</a>';
        } else {
            echo '<a class="active" href="login.php">Login</a>';
        }
        ?>
   
</div>