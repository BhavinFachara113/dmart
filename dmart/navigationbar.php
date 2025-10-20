<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./css/navigation1.css">
</head>

<body>

    <div id="div1">
        <div id="logo">
            <img id="logo1" src="./img/logo2.jpg" alt="">
        </div>

        <div id="time">
            <a id="time_msg1">Earliest <a id="time_msg2"> Home Delivery</a> available</a>
            <p id="msg3"><img id="timer" src="./img/clock.jpg" alt=""> <a id="msg4"> Tomorrow 07:00 AM - 10:00 AM</a></p>
        </div>

        <div id="serch">
            <input type="text" id="serch1" placeholder="Serch for Tea,Coffee,Noodles....">
            <button id="serch_btn">Serch</button>
        </div>

        <div id="login">
            <img id="user" src="./img/user.jpg" alt="">
             <?php
                 if(isset($_SESSION['any']))
                {
                  ?>
                   <a href="./logout.php" id="singin" style="text-decoration: none;color:green;">Logout</a>
                   <?php
                }
                else
                {
                  ?>
                   <a href="./login.php" id="singin" style="text-decoration: none;color:green;">Sign In/</a><a href="./registration.php" style="margin-top: 10px;text-decoration: none;color:green;">Register</a>
                   <?php
                }
              ?>
        </div>
        <div id="notification">
            <a href="./notification.php"><img id="notification_img" src="./img/notification.jpg" alt=""></a>
        </div>
        <div id="cart">
        <a href="./cart.php"><img src="./img/cart.jpg" id="cart_img" alt=""></a>
        </div>
    </div>
    <div id="nev2">
        <div id="categories">
            <div id="all_categories">
                <a id="allmenu" href="./AllCategories.php" ><img id="item" src="./img/menu.jpg" alt=""> All Categories</a>
            </div>
        </div>

        <div id="page">
            <div id="pagelist">
                <a href="./index.php" id="pagename">Ready To Cook</a>
                <a href="./grocery.php" id="pagename">Grocery</a>
                <a href="./Home Appliances.php" id="pagename">Home Appliances</a>
                <a href="./Cookware.php" id="pagename">Cookware</a>
                <a href="./Serveware.php" id="pagename">Serveware</a>
                <a href="./Cleaners.php" id="pagename">Cleaners</a>
                <a href="./Detergent & Fabric Care.php" id="pagename">Detergent & Fabric Care</a>
            </div>
        </div>
    </div>
</body>

</html>

<?php
?>