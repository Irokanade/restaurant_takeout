<?php include('adminNavbar.php'); ?>

<style>
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

    .display-middle1{position:absolute;top:50%;left:50%;transform:translate(-160%,-50%);-ms-transform:translate(-50%,-50%)}
    .display-middle2{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%)}
    .display-middle3{position:absolute;top:50%;left:50%;transform:translate(60%,-50%);-ms-transform:translate(-50%,-50%)}
    .center{text-align:center!important}
    .text-white{color:#000!important}

</style>

<h1>Welcome Admin!</h1>
<h2>
    <br><br>
   What would you like to view?
</h2>

<div></div>
<div class="display-middle1 center">
  <p><a href="adminRestPage.php"><button class="btn-31"><span class="text-container"><span class="text">Restaurant</span></span></button></a></p>
</div>
<div class="display-middle2 center">
  <p><a href="adminUsersPage.php"><button class="btn-31"><span class="text-container"><span class="text">User</span></span></button></a></p>
</div>
<div class="display-middle3 center">
  <p><a href="adminOrdersPage.php"><button class="btn-31"><span class="text-container"><span class="text">Order</span></span></button></a></p>
</div>
</div>



