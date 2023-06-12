<?php
    include('sessionCustomer.php');
    include("config.php");
    $order_id = $_SESSION['orderPlaced'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve pickup_datetime from the form
        $pickup_datetime = $_POST["pickup_datetime"];
    
        // Update the pickuptime and orderstatus in the order table
        $sql = "UPDATE `order` SET `pickup_time` = '$pickup_datetime', `order_status` = 'Pending' WHERE `order_id` = '$order_id'";
        $conn->query($sql);
        $_SESSION['orderPlaced'] = null;
    
        // Redirect to the desired page
        header("location: restaurants.php");
        exit;
    }
?>
<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    choose pickup time

    <form action="" method="post">  

        <label>Pickup Date and Time:</label>
        <input type="datetime-local" name="pickup_datetime" required /><br /><br />

        <input type="submit" value="Submit" /><br />
    </form>
</body>
</html>