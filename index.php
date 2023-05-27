<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_takeout_db";

// Connect to MySQL server
$conn = new mysqli($servername, $username, $password, $dbname);

// Set up character set
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// SQL query to retrieve restaurant data
$sql = "SELECT * FROM restaurant";
$result = $conn->query($sql);    // Send SQL query

while ($row = mysqli_fetch_assoc($result)) {
    $restID = $row['rest_id'];
    $restName = $row['rest_name'];
    $restTelpNum = $row['rest_telp_num'];
    $restAddress = $row['rest_address'];
    $restDescription = $row['rest_description'];
    $restOperatingHours = $row['rest_operating_hours'];

    // Generate HTML code for each restaurant
    echo "<div>";
    echo "<h3>Restaurant ID: $restID</h3>";
    echo "<p>Name: $restName</p>";
    echo "<p>Telephone Number: $restTelpNum</p>";
    echo "<p>Address: $restAddress</p>";
    echo "<p>Description: $restDescription</p>";
    echo "<p>Operating Hours: $restOperatingHours</p>";
    echo "</div>";
}

// Close the database connection
$conn->close();

?>