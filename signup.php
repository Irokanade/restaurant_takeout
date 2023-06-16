<?php include('navbar.php'); ?>
<?php
   include("config.php");
   session_start();

   $errorMsg = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusrname = mysqli_real_escape_string($conn,$_POST['username']);
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $myphone = mysqli_real_escape_string($conn,$_POST['phone']);
      $mypasswd = mysqli_real_escape_string($conn,$_POST['password']); 
      $mytype = mysqli_real_escape_string($conn,$_POST['usertype']);
      
      $checkEmailSql = "SELECT * FROM login_cred WHERE user_email = '$myemail'";
      $result = $conn->query($checkEmailSql);
      if ($result->num_rows > 0) {
         $errorMsg = "This Email address already exists!";
      } else {
         $insertSql = "INSERT INTO login_cred (user_name, user_email, user_password, user_type) VALUES ('$myusrname', '$myemail', '$mypasswd', '$mytype')";
         if($conn->query($insertSql) == TRUE) {
            if($mytype === "customer") {
               $my_loginid = $conn->insert_id;
            $insertSql = "INSERT INTO customer (cust_name, cust_telp_num) VALUES ('$myusrname', '$myphone')";
            if ($conn->query($insertSql) === TRUE) {
               $my_custid = $conn->insert_id;
               $insertSql = "INSERT INTO cust_login_cred(cust_id, login_id) VALUES ('$my_custid', '$my_loginid')";
               if ($conn->query($insertSql) === TRUE) {
                  echo "<script>alert('Success');</script>";
                  header("location: login.php");
               }
            }
            } else if($mytype === "restaurant") {
               $my_loginid = $conn->insert_id;
               $insertSql = "INSERT INTO restaurant (rest_name, rest_address, rest_open_status, rest_telp_num) VALUES ('$myusrname', '*', '*', '$myphone')";
               if ($conn->query($insertSql) === TRUE) {
                  $my_restid = $conn->insert_id;
                  $insertSql = "INSERT INTO rest_login_cred(rest_id, login_id) VALUES ('$my_restid', '$my_loginid')";
                  if ($conn->query($insertSql) === TRUE) {
                     echo "<script>alert('Success');</script>";
                     header("location: login.php");
                  }
               } 
            }
         }
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
   
   <body bgcolor = "#CEE9F3">
      <br/>
      <div align = "center">
         <div style = "background-color:#CEE9F3; width:370px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Sign in</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post" onsubmit="return checkPassword()">
                  <label>UserName: &ensp;</label>
                  <input type = "text" name = "username" class = "box" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required><br/><br/>
                  <label>Email: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type = "text" name = "email" class = "box" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required><br/><br/>
                  <label>Phone: &ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type = "text" name = "phone" class = "box" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required><br/><br/>
                  <label>Password: &ensp;&ensp;</label>
                  <input type = "password" id="password" name = "password" class = "box" required>
                  <button type="button" id="showPasswordButton" onclick="togglePasswordVisibility()">Show</button>
                  <input type="hidden" name="show_password" value="<?php echo $showPassword ? '1' : '0'; ?>"><br/><br/>
                  <label>Confirm Password: </label><br/>
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<input type = "password" id="confirmPassword" class = "box" required><br/><br/>
                  <label>User Type:</label>&ensp;&ensp;
                  <select name="usertype" class="box">
                     <option value="customer">Customer</option>
                     <option value="restaurant">Restaurant</option>
                  </select><br><br>
                  <input style = "background:#5085C4; color:white;" type = "submit" value = " Submit "/><br/>
               </form>
               <div style="font-size: 16px; color: #cc0000; font-weight:bold; margin-top: 10px;"><?php echo $errorMsg; ?></div>
            </div>
         </div>
      </div>
   </body>
</html>

