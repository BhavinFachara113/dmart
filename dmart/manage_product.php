<?php
include("config.php");
error_reporting(0);
include("navigationbar.php");
$table;
$logo;
$item;
$buy_1_and_get_1;
$file;
$sort_name;
$grocery = $_GET['grocery_name'];
$cookware = $_GET['cookware_name'];
$ready_to_cook = $_GET['ready_to_cook'];
$detergent_and_fabric = $_GET['detergent_and_fabric'];
$home_appliances=$_GET['home_appliances'];
$serveware=$_GET['serveware_name'];
$cleaners=$_GET['cleaners'];

if($ready_to_cook!=null)
{
    $table="ready_to_cook";
    $sort_name=$ready_to_cook;
    $logo="buy_one_get_one2.jpg";
    $file="product_detail.php";
    $buy_1_and_get_1="Buy_1_Get_1";
    $item="Weight";
}
elseif($grocery!=null)
{
    $table="grocery";
    $sort_name=$grocery;
    $logo="buy_one_get_one2.jpg";
    $file="grocery_detail.php";
    $buy_1_and_get_1="Buy_1_Get_1";
    $item="Weight";   
}
elseif($home_appliances!=null)
{
    $table="home_appliances";
    $sort_name=$home_appliances;
    $logo="50_off_logo.jpg";
    $file="home_product_detail.php";
    $buy_1_and_get_1="BUY_1_GET_1";
    $item="Voltage";   
}
elseif($cookware!=null)
{
    $table="cookware";
    $sort_name=$cookware;
    $logo="50_off_logo.jpg";
    $file="cookware_detail.php";
    $buy_1_and_get_1="Buy_1_Get_1";
    $item="Variant";   
}
elseif($serveware!=null)
{
    $table="serveware";
    $sort_name=$serveware;
    $logo="50_off_logo.jpg";
    $file="serveware_detail.php";
    $buy_1_and_get_1="Buy_1_Get_1";
    $item="Pieces";   
}
elseif($cleaners!=null)
{
    $table="cleaners";
    $sort_name=$cleaners;
    $logo="buy_one_get_one2.jpg";
    $file="cleaners_detail.php";
    $buy_1_and_get_1="Buy_1_Get_1";
    $item="Weight";   
}
elseif($detergent_and_fabric!=null)
{
    $table="detergent_and_fabric";
    $sort_name=$detergent_and_fabric;
    $logo="buy_one_get_one2.jpg";
    $file="detergent_and_fabric_detail.php";
    $buy_1_and_get_1="Buy_1_Get_1";
    $item="Weight";   
}

$newprice = 0;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Dmart</title>
    <link rel="stylesheet" href="./css/index.css">
    <script>
        function product_count(action, id) {
            // Get the input field by its unique ID
            var inputField = document.getElementById('quantity_' + id);
            var hiddenField = document.getElementById('hidden_quantity_' + id); 
            // Get the current value of the input field and convert it to an integer
            var currentQuantity = parseInt(inputField.value);

            // If currentQuantity is NaN (not a number), set it to 1
            if (isNaN(currentQuantity)) {
                currentQuantity = 1;
            }

            // If action is 'add', increase the quantity
            if (action === 'add') {
                inputField.value = currentQuantity + 1;
            }
            // If action is 'remove', decrease the quantity, but not below 1
            else if (action === 'remove' && currentQuantity > 1) {
                inputField.value = currentQuantity - 1;
            }
            hiddenField.value = currentQuantity;
        }
    </script>



</head>

<body>
    <div id="main_div">

        <?php
        $select = "select * from $table where Sort_Name=$sort_name";
        $data = $c->query($select);
        while ($row = $data->fetch_assoc()) {
            if ($row['Status'] == 1) {
        ?>
                <form method="post" action="menege_cart.php">
                    <div id="product">
                        <div id="product_buy_and_veg">

                            
                            <?php
                            if($ready_to_cook!=null || $grocery !=null)
                            {
                                ?>
                                     <img id="veg" src="./img/product/veg.jpg" alt="">
                                <?php
                            }
                            if ($row[$buy_1_and_get_1] == "Yes") {
                            ?>
                                <img id="buy_one_get_one" style="margin-left: 255px;" src="./img/product/<?php echo $logo; ?>" alt="">
                            <?php
                            }
                            ?>
                        </div>
                        <a href="<?php echo $file; ?>?btn_show=<?php echo $row['Id']; ?>"><img id="product_img" src="<?php echo $row['Image'] ?>" alt=""></a>
                        <p id="product_name"><?php echo $row['Name']; ?>:<?php echo $row[$item]; ?></p>

                        <div id="price">
                            <div id="mrp">
                                <p>MRP</p>
                                <p><?php echo $row['MRP']; ?></p>
                            </div>
                            <div id="dmart">
                                <p id="dmart_price">Dmart</p>
                                <?php
                                if ($row[$buy_1_and_get_1] == "Yes") {
                                    $newprice = $row['Dmart'] / 2;
                                ?>
                                    <p><?php echo $newprice; ?></p>
                                <?php
                                } else {
                                ?>
                                    <p><?php echo $row['Dmart']; ?></p>
                                <?php
                                }
                                ?>
                            </div>
                            <div id="discount">
                                <?php
                                if ($row[$buy_1_and_get_1] == "Yes") {
                                ?>
                                    <p id="discount_in_number"><?php echo $newprice + $row['Save']; ?></p>
                                    <?php
                                    $newprice = 0;
                                    ?>
                                <?php
                                } else {
                                ?>
                                    <p id="discount_in_number"><?php echo $row['Save']; ?></p>
                                <?php
                                }
                                ?>
                                <p id="discount_in_persenteg">OFF</p>
                            </div>
                        </div>

                        <p id="taxes">(Inclusive of all taxes)</p>

                        <div id="wight_cart">
                            <div id="wigth">
                                <p style="margin-left: 5px;"><?php echo $row[$item]; ?></p>
                            </div>

                            <div id="cart_number">
                                <!-- Add "+" button to increase quantity -->
                                <input type="button" id="cart_number_add" value="+" onclick="product_count('add', '<?php echo $row['Id']; ?>')" />

                                <!-- Display the current quantity, give the input a unique ID -->
                                <input type="text" class="cart_number_display" id="quantity_<?php echo $row['Id']; ?>" value="1" readonly />

                                <!-- Add "-" button to decrease quantity -->
                                <input type="button" id="cart_number_remove" value="-" onclick="product_count('remove', '<?php echo $row['Id']; ?>')" />
                            </div>

                        </div>


                        <div id="cart_product">
                            <img id="cart_icon" src="./img/product/cart.jpg" alt="">
                            <input type="submit" style=" background-color: rgb(37, 165, 65s);" name="ADD_TO_CART" id="cart_product_button" value="ADD TO CART"></input>
                            <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
                            <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
                            <?php
                            if ($row[$buy_1_and_get_1] == "Yes") {
                                $newprice = $row['Dmart'] / 2;
                            ?>
                                <input type="hidden" name="product_dmart" value="<?php echo $newprice; ?>" />
                            <?php
                            } else {
                            ?>
                                <input type="hidden" name="product_dmart" value="<?php echo $row['Dmart']; ?>" />
                            <?php
                            }
                            ?>
                            <?php
                                if($row[$buy_1_and_get_1] == "Yes")
                                {
                                     ?>
                                      <input type="hidden" name="product_save" value="<?php echo $newprice+$row['Save']; ?>" />
                                    <?php
                                }
                                else
                                {
                                    ?>
                                      <input type="hidden" name="product_save" value="<?php echo $row['Save']; ?>" />
                                    <?php
                                }
                            ?>
                            <input type="hidden" name="product_countity" value="1" id="quantity_<?php echo $row['Id']; ?>"/>
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