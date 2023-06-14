<?php include('navbar.php'); ?>
<?php
   include("config.php");
   session_start();

   $errorMsg = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusrname = mysqli_real_escape_string($conn,$_POST['username']);
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $myphone = mysqli_real_escape_string($conn,$_POST['phone']);
      $newpassword = mysqli_real_escape_string($conn,$_POST['new_password']);
      $confirmpassword = mysqli_real_escape_string($conn,$_POST['confirm_password']);
      
      $checkUserSql = "SELECT * FROM customer c INNER JOIN cust_login_cred clc ON c.cust_id = clc.cust_id INNER JOIN login_cred lc ON clc.login_id = lc.login_id WHERE lc.user_name = '$myusrname' AND lc.user_email = '$myemail' AND c.cust_telp_num = '$myphone'";
      $result = $conn->query($checkUserSql);
      
      if ($result->num_rows > 0) {
         if ($newpassword == $confirmpassword) {
            $updateSql = "UPDATE login_cred SET user_password = '$newpassword' WHERE user_name = '$myusrname' AND user_email = '$myemail'";
            if ($conn->query($updateSql) === TRUE) {
               echo "<script>alert('Password updated successfully');</script>";
               header("location: login.php");
            } else {
               $errorMsg = "Failed to update password";
            }
         } else {
            $errorMsg = "Passwords don't match";
         }
      } else {
         $errorMsg = "Invalid user details";
      }      
   }
?>

<html>
   
   <head>
      <title>Forgot Password</title>
      
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
      
      <script>
         function checkPassword() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (newPassword != confirmPassword) {
               alert("Passwords don't match");
               return false;
            }

            return true;
         }
         function togglePasswordVisibility() {
            var passwordInput = document.getElementById("new_password");
            var showPasswordButton = document.getElementById("showPasswordButton");

            if (passwordInput.type === "password") {
               passwordInput.type = "text";
               showPasswordButton.textContent = "Hide";
            } else {
               passwordInput.type = "password";
               showPasswordButton.textContent = "Show";
            }
         }
      </script>
   </head>
   
   <body bgcolor = "#CEE9F3">
      <br/>
      <div align = "center">
         <div style = "background-color:#CEE9F3; width:370px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Reset Password</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post" onsubmit="return checkPassword()">
                  <label>UserName: &ensp;&ensp;&ensp;&ensp;</label>
                  <input type = "text" name = "username" class = "box" required><br/><br/>
                  <label>Email: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type = "text" name = "email" class = "box" required><br/><br/>
                  <label>Phone: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type = "text" name = "phone" class = "box" required><br/><br/>
                  <label>New Password: </label>
                  <input type = "password" id="new_password" name = "new_password" class = "box" required>
                  <button type="button" id="showPasswordButton" onclick="togglePasswordVisibility()">Show</button><br/><br/>
                  <label>Confirm Password: </label><br/>
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<input type = "password" id="confirm_password" name = "confirm_password" class = "box" required><br/><br/>
                  <input style = "background:#5085C4; color:white;" type = "submit" value = " Update "/><br/>
               </form>
               <div style="font-size: 16px; color: #cc0000; font-weight:bold; margin-top: 10px;"><?php echo $errorMsg; ?></div>
            </div>
         </div>
      </div>
   </body>
</html>
