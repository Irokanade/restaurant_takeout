<?php
include('sessionRestaurant.php');
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $login_id = $_POST['login_id'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the password fields
    if ($user_password !== $confirm_password) {
        echo '<script>alert("Passwords do not match.");</script>';
    } else {
        // Update the user password in the database
        $update_sql = "UPDATE login_cred SET user_password = '$user_password' WHERE login_id = '$login_id'";
        $update_result = $conn->query($update_sql);

        if ($update_result) {
            // User password updated successfully
            echo '<script>alert("Password updated successfully.");</script>';
        } else {
            // Error occurred while updating user password
            echo '<script>alert("Error: ' . $conn->error . '");</script>';
        }
    }
}

// Retrieve the user information from the database
$select_sql = "SELECT * FROM login_cred WHERE login_id = '$login_session'";
$select_result = $conn->query($select_sql);

if ($select_result->num_rows > 0) {
    $row = mysqli_fetch_array($select_result, MYSQLI_ASSOC);
    $login_id = $row["login_id"];
    $user_name = $row["user_name"];
    $user_email = $row["user_email"];
    $user_type = $row["user_type"];
} else {
    // User information not found
    echo '<script>alert("User information not found.");</script>';
}
?>

<?php include('r_navbar.php'); ?>
<html>
<head>
    <title>Change Password</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-field {
            margin-bottom: 10px;
        }

        .form-field input[type="password"] {
            width: 100%;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            margin-bottom: 10px;
        }

        .form-actions {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Profile</h2>

    <div class="form-field">
        <label for="user_email">E-mail:</label>
        <span id="user_email"><?php echo $user_email; ?></span>
    </div>

    <div class="form-field">
        <label for="user_type">User type:</label>
        <span id="user_type"><?php echo ($user_type == '1') ? 'customer' : 'restaurant'; ?></span>
    </div>
    
    <h2>Change Password</h2>
    <?php
    if (isset($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
    if (isset($success_message)) {
        echo '<div class="success-message">' . $success_message . '</div>';
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="login_id" value="<?php echo $login_id; ?>">

        <div class="form-field">
            <label for="user_password">New Password:</label>
            <input type="password" id="user_password" name="user_password" required>
        </div>

        <div class="form-field">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="form-actions">
            <input type="submit" value="update password">
        </div>
    </form>
</div>
</body>
</html>
