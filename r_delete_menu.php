<?php
    include('session.php');
    include("config.php");

    // 获取要删除的菜单项的ID
    $menu_id = $_GET['menu_id'];

    // 删除菜单项的SQL语句
    $delete_sql = "DELETE FROM menu WHERE menu_id = '$menu_id'";

    if ($conn->query($delete_sql) === TRUE) {
        // 删除成功后进行重定向到菜单列表页面
        header("Location: r_menu.php?rest_id=$rest_id");
        exit();
    } else {
        echo "Error deleting menu item: " . $conn->error;
    }

    $conn->close();
?>
