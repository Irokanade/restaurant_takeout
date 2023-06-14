<?php
    include('sessionRestaurant.php');
    include("config.php");

if(!isset($_SESSION['login_user'])){
            echo '<li><a class="active" href="login.php">Login';
        } else {
<<<<<<< HEAD
            $orderQuery = "SELECT o.*
=======
            $orderQuery = "SELECT Distinct o.*, c.cust_name, c.cust_telp_num
>>>>>>> main
            FROM `order` o
            JOIN cust_order co ON o.order_id = co.order_id
            JOIN order_items oi ON oi.order_id = co.order_id
            JOIN restaurant_menu rm ON rm.menu_id = oi.menu_id
            JOIN rest_login_cred rlc ON rlc.rest_id = rm.rest_id
<<<<<<< HEAD
            WHERE rlc.login_id = '$login_session'"; 
            $orderResult = $conn->query($orderQuery);
        }
?>
<?php include('navbar.php'); ?>
=======
            JOIN customer c ON c.cust_id = co.cust_id
            WHERE rlc.login_id =  '$login_session'"; 

            $orderResult = $conn->query($orderQuery);
        }
?>
<?php include('r_navbar.php'); ?>
>>>>>>> main
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
   // 注文情報がある場合にテーブルを表示
   if (mysqli_num_rows($orderResult) > 0) {
      while ($row = mysqli_fetch_assoc($orderResult)) {
<<<<<<< HEAD
      echo "<table bgcolor= #CEE9F3 border = solid width = 50%;>
=======
      echo "<table bgcolor= #CEE9F3 border = solid width = 70%;>
>>>>>>> main
               <tr>
                  <th>&ensp;Order ID&ensp;</th>
                  <th>&ensp;Total Cost&ensp;</th>
                  <th>&ensp;Status&ensp;</th>
                  <th>&ensp;Pickup Time&ensp;</th>
<<<<<<< HEAD
=======
                  <th>&ensp;Name&ensp;</th>
                  <th>&ensp;Phone&ensp;</th>
>>>>>>> main
               </tr>";

         $orderId = $row['order_id'];
         $orderTotalCost = $row['order_total_cost'];
         $orderStatus = $row['order_status'];
         $pickupTime = $row['pickup_time'];
<<<<<<< HEAD
=======
         $cusename = $row['cust_name'];
         $custtel = $row['cust_telp_num'];
>>>>>>> main

         echo "<tr>
                  <td>&ensp;$orderId&ensp;</td>
                  <td>&ensp;$orderTotalCost&ensp;</td>
                  <td>&ensp;$orderStatus&ensp;</td>
                  <td>&ensp;$pickupTime&ensp;</td>
<<<<<<< HEAD
=======
                  <td>&ensp;$cusename&ensp;</td>
                  <td>&ensp;$custtel&ensp;</td>
>>>>>>> main
               </tr>";

         $menuQuery = "SELECT m.food_name, m.food_price
                       FROM order_items oi
                       JOIN menu m ON oi.menu_id = m.menu_id
                       WHERE oi.order_id = $orderId";

         $menuResult = mysqli_query($conn, $menuQuery);

         if (mysqli_num_rows($menuResult) > 0) {
            echo "<tr>
<<<<<<< HEAD
                     <td colspan='5'>
=======
                     <td colspan='6'>
>>>>>>> main
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