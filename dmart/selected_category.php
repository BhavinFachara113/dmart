<?php
include("config.php");
include("navigationbar.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Dmart</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div id="main_div">

        <?php
        $select = "select * from home_appliances";
        $data = $c->query($select);
        while ($row = $data->fetch_assoc()) {
            if ($row['Status'] == 1)
            {
               ?>
                <form method="post" action="menege_cart.php">
                <div id="product">
                    <img id="veg" src="./img/product/veg.jpg" alt="">
                    <a href="home_product_detail.php?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                    <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row['Voltage']; ?></p>

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
                    <div id="wigth"><p style="margin-left: 5px;"><?php echo $row['Voltage']; ?></p></div>

                    <div id="cart_product">
                        <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                        <input type="submit" style=" background-color: rgb(37, 165, 65);"  name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                        <input type="hidden" name="product_name"  value="<?php  echo$row['Name'];?>"/>
                        <input type="hidden" name="product_image" value="<?php  echo$row['Image'];?>"/>
                        <input type="hidden" name="product_dmart" value="<?php  echo$row['Dmart'];?>"/>
                        <input type="hidden" name="product_save"  value="<?php  echo$row['Save'];?>"/>
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
include("footer.php");
?>