<?php include('navbar.php'); ?>
<?php
   include("config.php");
   session_start();
   $errorMsg = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM login_cred WHERE user_email = '$myusername' and user_password = '$mypassword'";
      $result = $conn->query($sql);	// Send SQL Query

      if ($result->num_rows == 1) {	
         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['login_user'] = $myusername;
        $_SESSION['login_type'] = $row["user_type"];
        if($_SESSION['login_type'] == "customer") {
         header("location: restaurants.php");
        } else if($_SESSION['login_type'] == "restaurant") {
         header("location: r_mainpage.php");
        } else if($_SESSION['login_type'] == "admin") {
         header("location: adminMainPage.php");
        }
      } else {
        $errorMsg = "Your Email or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
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
         } a {
           display: block;
           color: #000000;
           font-weight: bold;
           text-decoration: underline;
         }
         .box {
            border:#666666 solid 1px;
         }
         
      </style>
      <script>
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
               
               <form action = "" method = "post">
                  <label>Email: &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</label>
                  <input type = "text" name = "email" class = "box" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required><br/><br/>
                  <label>Password: &ensp;&ensp;</label>
                  <input type = "password" id="password" name = "password" class = "box" required>
                  <button type="button" id="showPasswordButton" onclick="togglePasswordVisibility()">Show</button><br><br>
                  <input type = "submit" value = " Submit "/><br />
               </form>
               <a href="signup.php">Sign up</a><br/>
               <a href="forgot_pass.php">Forgot password</a><br/>
               <div style="font-size: 16px; color: #cc0000; font-weight:bold; margin-top: 10px;"><?php echo $errorMsg; ?></div>
            </div>
				
         </div>
			
      </div>

   </body>
</html>