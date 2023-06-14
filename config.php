<?php
   $servername = "localhost";
   $username = "root";
   $password = "2PutaGbC";
   $dbname = "restaurant_takeout_db";
   
   // Connect MySQL server
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   // set up char set
   if (!$conn->set_charset("utf8")) {
       printf("Error loading character set utf8: %s\n", $conn->error);
       exit();
   }
   
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   } 
?>