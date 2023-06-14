<?php
   include("config.php");
   include("sessionCustomer.php");
   include("navbar.php");

   $errorMsg = "";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusrname = mysqli_real_escape_string($conn, $_POST['username']);
      $myemail = mysqli_real_escape_string($conn, $_POST['email']);
      $myphone = mysqli_real_escape_string($conn, $_POST['phone']);
      $mypasswd = mysqli_real_escape_string($conn, $_POST['password']);
      $confirmPasswd = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
      
      if ($mypasswd != $confirmPasswd) {
         $errorMsg = "Passwords do not match!";
      } else {
         $updateSql = "UPDATE login_cred SET user_name = '$myusrname', user_email = '$myemail', user_password = '$mypasswd' WHERE login_id = '$login_session'";
         if ($conn->query($updateSql) === TRUE) {
               $updateCustSql = "UPDATE customer SET cust_name = '$myusrname', cust_telp_num = '$myphone' WHERE cust_id = '$login_session'";
               if ($conn->query($updateCustSql) === TRUE) {
                  echo "<script>alert('Update Successful');</script>";
               }
         } else {
            $errorMsg = "Failed to update record: " . $conn->error;
         }
      }
   }
?>

<html>
   
   <head>
      <title>Update Profile</title>
      
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
         }
         .box {
            border: #666666 solid 1px;
         }
      </style>
      
      <script>
         function checkPassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password != confirmPassword) {
               alert("Passwords doesn't match");
               return false;
            }

            return true;
         }
         function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
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
   
   <body bgcolor="#CEE9F3">
      <br/>
      <div align="center">
         <div style="background-color:#CEE9F3; width:370px; border: solid 1px #333333; " align="left">
            <div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Update Profile</b></div>
            
            <div style="margin:30px">
               <?php
               		$sql = "SELECT login_cred.*, customer.cust_telp_num
					FROM login_cred
					JOIN cust_login_cred ON login_cred.login_id = cust_login_cred.login_id
					JOIN customer ON cust_login_cred.cust_id = customer.cust_id
					WHERE login_cred.login_id = '$login_session'";
					$result = $conn->query($sql);
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                	$user_name = $row["user_name"];
                	$user_email = $row["user_email"];
                	$user_tel = $row["cust_telp_num"];
                	$user_pass = $row["user_password"];

               ?>
               <form action="" method="post" onsubmit="return checkPassword()">
                  <label>UserName: &ensp;</label>
                  <input type="text" name="username" class="box" value="<?php echo $user_name ?>" required><br/><br/>
                  <label>Email: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type="text" name="email" class="box" value="<?php  echo $user_email?>" required><br/><br/>
                  <label>Phone: &ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type="text" name="phone" class="box" value="<?php  echo $user_tel?>" required><br/><br/>
                  <label>Password: &ensp;&ensp;</label>
                  <input type="password" id="password" name="password" class="box" value="<?php  echo $user_pass?>"required>
                  <button type="button" id="showPasswordButton" onclick="togglePasswordVisibility()">Show</button>
                  <input type="hidden" name="show_password" value="<?php echo $showPassword ? '1' : '0'; ?>"><br/><br/>
                  <label>Confirm Password: </label><br/>
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<input type="password" id="confirmPassword" name="confirmPassword" class="box" value="<?php  echo $user_pass?>"required><br/><br/>
                  <input style="background:#5085C4; color:white;" type="submit" value="Update"/><br/>
               </form>
               <div style="font-size: 16px; color: #cc0000; font-weight:bold; margin-top: 10px;"><?php echo $errorMsg; ?></div>
            </div>
         </div>
      </div>
   </body>
</html>
