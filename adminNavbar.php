<style>
    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        background-color: #81DCCD;
        overflow: hidden;
    }

    nav li.has {
        float: left;
    }

    nav li a {
        display: block;
        color: #333;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-family:'Lucida Sans';
        font-weight: bold;
    }

    nav li a:hover {
        background-color: #72C6B8;
    }

    nav li.acclogout {
        float : right;
    }
    
</style>

<nav>
    <ul>
        <li class="has"><a class="active" href="adminMainPage.php">Home</a></li>
        <li class="has"><a href="aboutUs.php">About Us</a></li>

        <?php
        if(!isset($_SESSION['login_user'])){
            echo '<li><a class="active" href="login.php">Login';
        } else {
            $sql = "SELECT user_name FROM login_cred WHERE login_id = '$login_session'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $user_name = $row["user_name"];
                if($user_name == NULL){
                    echo '<li><a class="active" href="login.php">Login';
                } else {
                    echo '<li class="acclogout"><a class="active" href="logout.php">Logout';
                    echo '</a></li>';
                    echo '<li class="acclogout"><a href="userpage.php">Hi ';
                    echo $user_name;                   
                }
            }   
        }
        
        ?></a></li>
        
    </ul>
</nav>