<?php
include("config.php");
error_reporting(0);
include("navigationbar.php");
$grocery = $_GET['grocery_name'];
$cookware = $_GET['cookware_name'];
$ready_to_cook = $_GET['ready_to_cook'];
$detergent_and_fabric = $_GET['detergent_and_fabric'];
$home_appliances=$_GET['home_appliances'];
$serveware=$_GET['serveware_name'];
if ($grocery != null) {
?>
    <html>

    <head>
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <div id="main_div">

            <?php
            $select = "select * from grocery where Sort_Name=$grocery;";
            $data = $c->query($select);
            while ($row = $data->fetch_assoc()) {
                if ($row['Status'] == 1) {
            ?>
                    <form method="post" action="menege_cart.php">
                        <div id="product">
                            <img id="veg" src="./img/product/veg.jpg" alt="">
                            <a href="grocery_detail.php?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                            <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row['Weight']; ?></p>

                            <div id="price">
                                <div id="mrp">
                                    <p>MRP</p>
                                    <p><?php echo $row['MRP']; ?></p>
                                </div>
                                <div id="dmart">
                                    <p id="dmart_price">Dmart</p>
                                    <p><?php echo $row['Dmart']; ?></p>
                                </div>
                                <div id="discount">
                                    <p id="discount_in_number"><?php echo $row['Save']; ?></p>
                                    <p id="discount_in_persenteg">OFF</p>
                                </div>
                            </div>

                            <p id="taxes">(Inclusive of all taxes)</p>
                            <div id="wigth">
                                <p style="margin-left: 5px;"><?php echo $row['Weight']; ?></p>
                            </div>

                            <div id="cart_product">
                                <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                                <input type="submit" style=" background-color: rgb(37, 165, 65);" name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                                <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
                                <input type="hidden" name="product_dmart" value="<?php echo $row['Dmart']; ?>" />
                                <input type="hidden" name="product_save" value="<?php echo $row['Save']; ?>" />
                            </div>

                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </body>

    </html>
<?php
} 

elseif ($ready_to_cook != null) 
{
?>
    <html>

    <head>
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <div id="main_div">

            <?php
            $select = "select * from ready_to_cook where Sort_Name=$ready_to_cook;";
            $data = $c->query($select);
            while ($row = $data->fetch_assoc()) {
                if ($row['Status'] == 1) {
            ?>
                    <form method="post" action="menege_cart.php">
                        <div id="product">
                            <img id="veg" src="./img/product/veg.jpg" alt="">
                            <a href="product_detail.php?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                            <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row['Weight']; ?></p>

                            <div id="price">
                                <div id="mrp">
                                    <p>MRP</p>
                                    <p><?php echo $row['MRP']; ?></p>
                                </div>
                                <div id="dmart">
                                    <p id="dmart_price">Dmart</p>
                                    <p><?php echo $row['Dmart']; ?></p>
                                </div>
                                <div id="discount">
                                    <p id="discount_in_number"><?php echo $row['Save']; ?></p>
                                    <p id="discount_in_persenteg">OFF</p>
                                </div>
                            </div>

                            <p id="taxes">(Inclusive of all taxes)</p>
                            <div id="wigth">
                                <p style="margin-left: 5px;"><?php echo $row['Weight']; ?></p>
                            </div>

                            <div id="cart_product">
                                <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                                <input type="submit" style=" background-color: rgb(37, 165, 65);" name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                                <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
                                <input type="hidden" name="product_dmart" value="<?php echo $row['Dmart']; ?>" />
                                <input type="hidden" name="product_save" value="<?php echo $row['Save']; ?>" />
                            </div>

                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </body>

    </html>
<?php
} 


elseif ($detergent_and_fabric != null) 
{
    $_SESSION['product'] = $ready_to_cook;
    echo "$detergent_and_fabric";
}



elseif ($home_appliances != null) 
{
?>
    <html>

    <head>
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <div id="main_div">

            <?php
            $select = "select * from home_appliances where Sort_Name=$home_appliances;";
            $data = $c->query($select);
            while ($row = $data->fetch_assoc()) {
                if ($row['Status'] == 1) {
            ?>
                    <form method="post" action="menege_cart.php">
                        <div id="product">
                            <img id="veg" src="./img/product/veg.jpg" alt="">
                            <a href="home_product_detail.php?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                            <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row['Weight']; ?></p>

                            <div id="price">
                                <div id="mrp">
                                    <p>MRP</p>
                                    <p><?php echo $row['MRP']; ?></p>
                                </div>
                                <div id="dmart">
                                    <p id="dmart_price">Dmart</p>
                                    <p><?php echo $row['Dmart']; ?></p>
                                </div>
                                <div id="discount">
                                    <p id="discount_in_number"><?php echo $row['Save']; ?></p>
                                    <p id="discount_in_persenteg">OFF</p>
                                </div>
                            </div>

                            <p id="taxes">(Inclusive of all taxes)</p>
                            <div id="wigth">
                                <p style="margin-left: 5px;"><?php echo $row['Voltage']; ?></p>
                            </div>

                            <div id="cart_product">
                                <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                                <input type="submit" style=" background-color: rgb(37, 165, 65);" name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                                <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
                                <input type="hidden" name="product_dmart" value="<?php echo $row['Dmart']; ?>" />
                                <input type="hidden" name="product_save" value="<?php echo $row['Save']; ?>" />
                            </div>

                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </body>

    </html>
<?php
} 

elseif ($cookware != null) 
{
?>
    <html>

    <head>
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <div id="main_div">

            <?php
            $select = "select * from cookware where Sort_Name=$cookware;";
            $data = $c->query($select);
            while ($row = $data->fetch_assoc()) {
                if ($row['Status'] == 1) {
            ?>
                    <form method="post" action="menege_cart.php">
                        <div id="product">
                            <img id="veg" src="./img/product/veg.jpg" alt="">
                            <a href="cookware_detail.php?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                            <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row['Weight']; ?></p>

                            <div id="price">
                                <div id="mrp">
                                    <p>MRP</p>
                                    <p><?php echo $row['MRP']; ?></p>
                                </div>
                                <div id="dmart">
                                    <p id="dmart_price">Dmart</p>
                                    <p><?php echo $row['Dmart']; ?></p>
                                </div>
                                <div id="discount">
                                    <p id="discount_in_number"><?php echo $row['Save']; ?></p>
                                    <p id="discount_in_persenteg">OFF</p>
                                </div>
                            </div>

                            <p id="taxes">(Inclusive of all taxes)</p>
                            <div id="wigth">
                                <p style="margin-left: 5px;"><?php echo $row['Variant']; ?></p>
                            </div>

                            <div id="cart_product">
                                <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                                <input type="submit" style=" background-color: rgb(37, 165, 65);" name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                                <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
                                <input type="hidden" name="product_dmart" value="<?php echo $row['Dmart']; ?>" />
                                <input type="hidden" name="product_save" value="<?php echo $row['Save']; ?>" />
                            </div>

                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </body>

    </html>
<?php
} 


elseif ($serveware != null) 
{
?>
    <html>

    <head>
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <div id="main_div">

            <?php
            $select = "select * from serveware where Sort_Name=$serveware;";
            $data = $c->query($select);
            while ($row = $data->fetch_assoc()) {
                if ($row['Status'] == 1) {
            ?>
                    <form method="post" action="menege_cart.php">
                        <div id="product">
                            <img id="veg" src="./img/product/veg.jpg" alt="">
                            <a href="serveware_detail.php?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                            <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row['Pieces']; ?></p>

                            <div id="price">
                                <div id="mrp">
                                    <p>MRP</p>
                                    <p><?php echo $row['MRP']; ?></p>
                                </div>
                                <div id="dmart">
                                    <p id="dmart_price">Dmart</p>
                                    <p><?php echo $row['Dmart']; ?></p>
                                </div>
                                <div id="discount">
                                    <p id="discount_in_number"><?php echo $row['Save']; ?></p>
                                    <p id="discount_in_persenteg">OFF</p>
                                </div>
                            </div>

                            <p id="taxes">(Inclusive of all taxes)</p>
                            <div id="wigth">
                                <p style="margin-left: 5px;"><?php echo $row['Pieces']; ?></p>
                            </div>

                            <div id="cart_product">
                                <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                                <input type="submit" style=" background-color: rgb(37, 165, 65);" name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                                <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
                                <input type="hidden" name="product_dmart" value="<?php echo $row['Dmart']; ?>" />
                                <input type="hidden" name="product_save" value="<?php echo $row['Save']; ?>" />
                            </div>

                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </body>

    </html>
<?php
} 

?>
