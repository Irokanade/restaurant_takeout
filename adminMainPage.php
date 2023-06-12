<style>
    /* CSS */
    .button-74 {
    background-color: #fbeee0;
    border: 2px solid #422800;
    border-radius: 30px;
    box-shadow: #422800 4px 4px 0 0;
    color: #422800;
    cursor: pointer;
    display: inline-block;
    font-weight: 600;
    font-size: 18px;
    padding: 0 18px;
    width: 200px;
    line-height: 50px;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    }

    .button-74:hover {
    background-color: #fff;
    }

    .button-74:active {
    box-shadow: #422800 2px 2px 0 0;
    transform: translate(2px, 2px);
    }

    @media (min-width: 768px) {
    .button-74 {
        min-width: 120px;
        padding: 0 25px;
    }
    }

    h1 {
        font-family: 'Lucida Sans';
        font-weight: bold;
        font-size: xx-large;
    }

    h2 {
        font-family: 'Lucida Sans';
        font-weight: bold;
        font-size: large;
    }

    .wel{
        background-color: #81DCCD;
    }
    
    .cont{
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }

    ul a {
        color: #333;
        text-align: right;
        padding: 14px 16px;
        text-decoration: none;
        list-style-type: none;
        font-family:'Lucida Sans';
        font-weight: bold;
        font-size: small;
        overflow: hidden;
    }

</style>

<div class="wel">
    <h1>
        <ul>
            <a href="logout.php">Logout</a>
        </ul>
        Welcome admin!
        <br></br>
    </h1>
</div>
<h2>
    <?php include('sessionAdmin.php');?>
    What would you like to do?
</h2>

<div class="cont">
    <a href="adminRestPage.php"><button class="button-74" role="button">Restaurants</button></a>
    <a href="adminUsersPage.php"><button class="button-74" role="button">Users</button></a>
    <a href="adminOrdersPage.php"><button class="button-74" role="button">Orders</button></a>
</div>
