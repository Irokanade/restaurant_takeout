<?php include('navbar.php'); ?>
<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusrname = mysqli_real_escape_string($conn,$_POST['username']);
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypasswd = mysqli_real_escape_string($conn,$_POST['password']); 
      $mytype = mysqli_real_escape_string($conn,$_POST['usertype']);
      
      $insertSql = "INSERT INTO login_cred (user_name, user_email, user_password, user_type) VALUES ('$myusrname', '$myemail', '$mypasswd', '$mytype')";
      if ($conn->query($insertSql) === TRUE) {
         echo "Successfully added";
         header("location: login.php");
      } else {
         echo "Error";
      }
   }
?>
<html>
   
   <head>
      <title>Sign in Page</title>
      
      <style type = "text/css">

         body {
            background: #87DFEE;
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         form {
            background: #CEE9F3;
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
   
   <body bgcolor = "#CEE9F3">
	
      <div align = "center">
         <div style = "background-color:#CEE9F3; width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Sign in</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName: </label><input type = "text" name = "username" class = "box"/><br/><br/>
                  <label>Email: &ensp;&ensp;&ensp;&ensp;</label><input type = "text" name = "email" class = "box"/><br/><br/>
                  <label>Password: </label><input type = "password" name = "password" class = "box" /><br/><br/>
                  <label>User Type:</label>
                  <select name="usertype" class="box">
                     <option value="customer">Customer</option>
                     <option value="restaurant">Restaurant</option>
                  </select><br><br>
                  <input style = "background:#5085C4; color:white;" type = "submit" value = " Submit "/><br/>
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php# echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>

