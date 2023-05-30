<?php
include "session.php";
include "config.php";

// set cust_id
$sql = "SELECT cust_id FROM cust_login_cred WHERE login_id = '$login_session'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if ($result->num_rows > 0) {
    $cust_id = $row["cust_id"];
}

$menu_id = $_GET["menu_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve menu_id and quantity from the form
    $quantity = $_POST["quantity"];
    $food_price = $_POST["food_price"];
    $orderPlaced = $_SESSION['orderPlaced'];
    $order_id = $_SESSION['orderPlaced'];

    // Check if orderPlaced
    if ($orderPlaced == null) {
        // Insert into order table and retrieve the newly inserted order_id
        $sql = "INSERT INTO `order` (`order_total_cost`, `order_status`, `pickup_time`) VALUES ('0', 'Not Placed', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'))";
        $conn->query($sql);

        // Retrieve the newly inserted order_id
        $order_id = $conn->insert_id;
        $orderPlaced = $order_id;
        $_SESSION['orderPlaced'] = $orderPlaced;
        // Insert into cust_order table
        $sql = "INSERT INTO `cust_order` (`cust_id`, `order_id`) VALUES ('$cust_id', '$order_id')";
        $conn->query($sql);

        // Insert into menu_order table
        for ($i = 0; $i < $quantity; $i++) {
            // update order table
            $sql = "UPDATE `order` SET `order_total_cost` = `order_total_cost` + '$food_price' WHERE `order_id` = '$order_id'";
            $conn->query($sql);

            $sql = "INSERT INTO `order_items` (`menu_id`, `order_id`) VALUES ('$menu_id', '$order_id')";
            $conn->query($sql);
         }

    } else {
        // Insert into menu_order table
        for ($i = 0; $i < $quantity; $i++) {
               // update order table
               $sql = "UPDATE `order` SET `order_total_cost` = `order_total_cost` + '$food_price' WHERE `order_id` = '$order_id'";
               $conn->query($sql);

               $sql = "INSERT INTO `order_items` (`menu_id`, `order_id`) VALUES ('$menu_id', '$order_id')";
               $conn->query($sql);
         }
    }

    // Redirect to restaurants.php
    echo '<script>alert("Order placed successfully!");</script>';
    header("Location: restaurants.php");
    exit;
}
?>

<?php include "navbar.php"; ?>

<html>
   
   <head>
      <title>Add To Cart</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Add Item To Cart</b></div>
				
            <div style = "margin:30px">
               
            <form action="" method="post">
               <?php
               // Retrieve food information from the menu table based on menu_id
               $sql = "SELECT * FROM menu WHERE menu_id = '$menu_id'";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $food_price = $row["food_price"];
                  echo "<label>Food Name: </label>" . $row["food_name"] . "<br /><br />";
                  echo "<label>Food Price: </label>" . $row["food_price"] . "<br /><br />";
                  echo "<label>Food Description: </label>" . $row["food_description"] . "<br /><br />";
                  ?>
                  <input type="hidden" name="food_price" value="<?php echo $food_price; ?>">
                  <label>Quantity: </label>
                  <input type="number" name="quantity" class="box" min="1" max="99" required /><br /><br />
                  <?php
               } else {
                  echo "Food not found.";
               }
               ?>
               <input type="submit" value="Submit" /><br />
            </form>


               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
