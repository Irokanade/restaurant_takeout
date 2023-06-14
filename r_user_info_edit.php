<?php
session_start();
include('sessionRestaurant.php');
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login_id = $_POST['login_id'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($user_password !== $confirm_password) {
        echo '<script>alert("Passwords do not match.");</script>';
    } else {
        $update_sql = "UPDATE login_cred SET user_password = '$user_password' WHERE login_id = '$login_id'";
        $update_result = $conn->query($update_sql);

        if ($update_result) {
            echo '<script>alert("Password updated successfully.");</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '");</script>';
        }
    }
}

$select_sql = "SELECT * FROM login_cred WHERE login_id = '$login_session'";
$select_result = $conn->query($select_sql);

if ($select_result->num_rows > 0) {
    $row = mysqli_fetch_array($select_result, MYSQLI_ASSOC);
    $login_id = $row["login_id"];
    $user_name = $row["user_name"];
    $user_email = $row["user_email"];
    $user_type = $row["user_type"];
} else {
    echo '<script>alert("User information not found.");</script>';
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include('r_navbar.php'); ?>
<html>
<head>
    <title>更改密碼</title>
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
    <h2>使用者資料</h2>
    <div class="form-field">
        <label for="user_name">使用者名稱:</label>
        <span id="user_name"><?php echo $user_name; ?></span>
    </div>

    <div class="form-field">
        <label for="user_email">電子郵件:</label>
        <span id="user_email"><?php echo $user_email; ?></span>
    </div>

    <div class="form-field">
        <label for="user_type">使用者類型:</label>
        <span id="user_type"><?php echo ($user_type == '1') ? '顧客' : '餐廳'; ?></span>
    </div>
    
    <h2>更改密碼</h2>
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
            <label for="user_password">新密碼:</label>
            <input type="password" id="user_password" name="user_password" required>
        </div>

        <div class="form-field">
            <label for="confirm_password">確認密碼:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="form-actions">
            <input type="submit" value="更新密碼">
        </div>
    </form>
</div>
</body>
</html>
