<?php
    include('sessionCustomer.php');
    include("config.php");

if(!isset($_SESSION['login_user'])){
            echo '<li><a class="active" href="login.php">Login';
        } else {
            $orderQuery = "SELECT o.*, r.rest_name
            FROM `cust_order` co
            JOIN `order` o ON co.order_id = o.order_id
            JOIN `restaurant_menu` rm ON o.order_id = rm.menu_id
            JOIN `restaurant` r ON rm.rest_id = r.rest_id
            JOIN `cust_login_cred` cl ON cl.cust_id = co.cust_id
            WHERE cl.login_id = '$login_session'"; 

            $orderResult = $conn->query($orderQuery);
        }
?>
<?php include('navbar.php'); ?>
<html>
<head>
   <title>Sign in Page</title>
   <style type="text/css">
      body {
         background: #87DFEE;
         font-family: Arial, Helvetica, sans-serif;
         font-size: 14px;
      }
      form {
         background: #CEE9F3;
      }
      label {
         font-weight: bold;
         width: 100px;
         font-size: 14px;
      } tr {
         border: solid 1px #333333;
      } th {
         border: solid 1px #333333;
      }
      .box {
         border: #666666 solid 1px;
      }
   </style>
</head>

<body bgcolor="#CEE9F3">
   <center>
   <br/>
   <?php

   if (mysqli_num_rows($orderResult) > 0) {
      while ($row = mysqli_fetch_assoc($orderResult)) {
      echo "<table bgcolor= #CEE9F3 border = solid width = 70%;>
               <tr>
                  <th>&ensp;Order ID&ensp;</th>
                  <th>&ensp;Total Cost&ensp;</th>
                  <th>&ensp;Status&ensp;</th>
                  <th>&ensp;Pickup Time&ensp;</th>
                  <th>&ensp;Restaurant Name&ensp;</th>
               </tr>";

         $orderId = $row['order_id'];
         $orderTotalCost = $row['order_total_cost'];
         $orderStatus = $row['order_status'];
         $pickupTime = $row['pickup_time'];
         $restname = $row['rest_name'];

         echo "<tr>
                  <td>&ensp;<a href='orderItems.php?order_id=".$row["order_id"]."'>" . $row["order_id"] . "</a></td>
                  <td>&ensp;$orderTotalCost&ensp;</td>
                  <td>&ensp;$orderStatus&ensp;</td>
                  <td>&ensp;$pickupTime&ensp;</td>
                  <td>&ensp;$restname&ensp;</td>
               </tr>";

         $menuQuery = "SELECT m.food_name, m.food_price
                       FROM order_items oi
                       JOIN menu m ON oi.menu_id = m.menu_id
                       WHERE oi.order_id = $orderId";

         $menuResult = mysqli_query($conn, $menuQuery);

         if (mysqli_num_rows($menuResult) > 0) {
            echo "<tr>
                     <td colspan='6'>
                        <table>
                           <tr>
                              <th>&ensp;Food Name&ensp;</th>
                              <th>&ensp;Food Price&ensp;</th>
                           </tr>";

            while ($menuRow = mysqli_fetch_assoc($menuResult)) {
               $foodName = $menuRow['food_name'];
               $foodPrice = $menuRow['food_price'];

               echo "<tr>
                        <td>&ensp;$foodName&ensp;</td>
                        <td>&ensp;$foodPrice</td>
                     </tr>";
            }

            echo "</td>
               </tr></table></table><br/>";
         }
      }

   } else {
      echo "No orders found.";
   }
   ?>
   <table/>
   <center/>
</body>
</html>