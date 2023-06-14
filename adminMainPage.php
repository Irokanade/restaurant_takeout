<?php include('sessionAdmin.php');?>
<?php include('adminNavbar.php'); ?>

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
        font-size: 60px;
        margin-left: 50px;
    }

    h2 {
        font-family: 'Lucida Sans';
        font-weight: bold;
        font-size: 20px;
        text-align: center;
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


    body {
    background: #679D6B;
    }

    .btn-31 {
    display: block;
    box-sizing: border-box;
    padding: 1.5rem 3.5rem;

    position: relative;
    
    background:none;
    color: white;
        
    text-transform: uppercase;
    border: 1px solid currentColor;
    
    --progress: 100%;
    
    }

    .btn-31:before {
    content: "";
    z-index: -1;

    position: absolute;
    inset: 0;


    background: #263427;
    clip-path: polygon(
        100% 0,
        var(--progress) var(--progress),
        0 100%,
        100% 100%
    );
    transition: clip-path 0.2s;
    }
    .btn-31:hover {
    --progress: 0%;
    }

    .btn-31 .text-container {
    display: block;
    position: relative;
    overflow: hidden;
    width: 180px;
    height: 180px;
    
    }
    .btn-31 .text {
    display: block;
    position: relative;
    font-size: 20px;
    font-weight: 900;
    mix-blend-mode: difference;
    text-align: center;
    }
    .btn-31:hover .text {
    animation: move-up-alternate 0.3s forwards;
    will-change: transform;
    }

    @keyframes move-up-alternate {
    from {
        transform: translateY(0%);
    }
    50% {
        transform: translateY(80%);
    }
    51% {
        transform: translateY(-80%);
    }
    100% {
        transform: translateY(0%);
    }
    }
    
    .center1 {
        float: center;
        margin: auto;
        padding: 10px;
        right: 250px;
        left: 0px;
        
    }
    .center2 {
        float: center;
        margin: auto;
        padding: 10px;
        right: 20px;
        left: 50px;
        
    }
    .center3 {
        float: center;
        margin: auto;
        padding: 10px;
   
    }

    .vertical-center {
    margin: 0;
    position: absolute;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    }

    .w3-grayscale-min{filter:grayscale(50%)}
    .w3-display-container{position:relative}
    .w3-display-bottomleft{position:absolute;left:0;bottom:0}
    .w3-tag{background-color:#000;color:#fff;display:inline-block;padding-left:8px;padding-right:8px;text-align:center}
    .w3-xlarge{font-size:24px!important}
    .w3-display-middle1{position:absolute;top:50%;left:50%;transform:translate(-160%,-50%);-ms-transform:translate(-50%,-50%)}
    .w3-display-middle2{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%)}
    .w3-display-middle3{position:absolute;top:50%;left:50%;transform:translate(60%,-50%);-ms-transform:translate(-50%,-50%)}
    .w3-center{text-align:center!important}
    .w3-text-white{color:#000!important}

</style>

<!--
<div class="wel">
    <h1>
        <ul>
            <a href="logout.php">Logout</a>
        </ul>
        Welcome admin!
        <br></br>
    </h1>
</div>
-->

<h1>Welcome Admin!</h1>
<h2>
    <br><br>
   What would you like to view?
</h2>


<!--
<div>
    <div class="center1"><a href="adminRestPage.php">
        <button class="btn-31">
            <span class="text-container">
                <span class="text">Restaurants</span>
            </span>
        </button></a></div>
    <div class="center2"><a href="adminUsersPage.php.php">
        <button class="btn-31">
            <span class="text-container">
                <span class="text">Users</span>
            </span>
        </button></a></div>
    <div class="center3"><a href="adminOrdersPage.php">
        <button class="btn-31">
            <span class="text-container">
                <span class="text">Orders</span>
                    </span>
            </button></a></div>
</div>-->


<div></div>
<div class="w3-display-middle1 w3-center">
  <p><a href="adminRestPage.php"><button class="btn-31"><span class="text-container"><span class="text">Restaurant</span></span></button></a></p>
</div>
<div class="w3-display-middle2 w3-center">
  <p><a href="adminUsersPage.php"><button class="btn-31"><span class="text-container"><span class="text">User</span></span></button></a></p>
</div>
<div class="w3-display-middle3 w3-center">
  <p><a href="adminOrdersPage.php"><button class="btn-31"><span class="text-container"><span class="text">Order</span></span></button></a></p>
</div>
</div>


<!-- End Content -->

