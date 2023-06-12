<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"SELECT login_id FROM login_cred WHERE user_name = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['login_id'];

   $orderPlaced = null;
   if(!isset($_SESSION['orderPlaced'])) {
      $_SESSION['orderPlaced'] = $orderPlaced;
  }
   
   if(!isset($_SESSION['login_user']) || ($_SESSION['login_type'] != "customer")){
      header("location:login.php");
      die();
   }

   
?>