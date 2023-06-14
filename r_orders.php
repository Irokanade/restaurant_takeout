<?php
    include('sessionRestaurant.php');
    include("config.php");

if(!isset($_SESSION['login_user'])){
            echo '<li><a class="active" href="login.php">Login';
        } else {
            $orderQuery = "SELECT Distinct o.*, c.cust_name, c.cust_telp_num
            FROM `order` o
            JOIN cust_order co ON o.order_id = co.order_id
            JOIN order_items oi ON oi.order_id = co.order_id
            JOIN restaurant_menu rm ON rm.menu_id = oi.menu_id
            JOIN rest_login_cred rlc ON rlc.rest_id = rm.rest_id
            JOIN customer c ON c.cust_id = co.cust_id
            WHERE rlc.login_id =  '$login_session'
            ORDER BY o.order_id DESC"; 

            $orderResult = $conn->query($orderQuery);
        }
?>
<?php include('r_navbar.php'); ?>
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
      echo "<table bgcolor= #CEE9F3 border = solid width = 70%;>
               <tr>
                  <th>&ensp;Order ID&ensp;</th>
                  <th>&ensp;Total Cost&ensp;</th>
                  <th>&ensp;Status&ensp;</th>
                  <th>&ensp;Pickup Time&ensp;</th>
                  <th>&ensp;Name&ensp;</th>
                  <th>&ensp;Phone&ensp;</th>
               </tr>";

         $orderId = $row['order_id'];
         $orderTotalCost = $row['order_total_cost'];
         $orderStatus = $row['order_status'];
         $pickupTime = $row['pickup_time'];
         $cusename = $row['cust_name'];
         $custtel = $row['cust_telp_num'];

         echo "<tr>
               <td>&ensp;$orderId&ensp;</td>
               <td>&ensp;$orderTotalCost&ensp;</td>
               <td>&ensp;$orderStatus&ensp;";
      
         // Confirmボタンを表示
         if ($orderStatus === "Pending") {
         echo "<form action='' method='POST'>
                  <input type='hidden' name='orderId' value='$orderId'>
                  <input type='hidden' name='action' value='confirm'>
                  <input type='submit' name='confirmBtn' value='Confirm'>
               </form>";
         }

         echo "</td>
               <td>&ensp;$pickupTime&ensp;</td>
               <td>&ensp;$cusename&ensp;</td>
               <td>&ensp;$custtel&ensp;</td>
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

   if (isset($_POST['action']) && $_POST['action'] === 'confirm' && isset($_POST['orderId'])) {
      $confirmedOrderId = $_POST['orderId'];

      $updateQuery = "UPDATE `order` SET order_status = 'Confirmed' WHERE order_id = $confirmedOrderId";
      $conn->query($updateQuery);
   }

   ?>
   <table/>
   <center/>
</body>
</html>