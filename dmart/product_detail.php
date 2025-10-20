<?php
include("config.php");
include("navigationbar.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="./css/product_detail.css">
</head>

<body>
  <?php
  $id = $_GET['btn_show'];
  $select = "select * from ready_to_cook where Id='$id';";
  $data = $c->query($select);
  $row = $data->fetch_assoc();
  ?>

  <form action="menege_cart.php" method="post">
    <div id="product_detail">
      <div id="product_img">
         <?php
              if($row["Buy_1_Get_1"]=="Yes")
              {
                 ?>
                    <div id="product_discount">
                    <img id="product_discount_img" src="./img/product/buy_one_get_one2.jpg" alt="">
                   </div>
                  <?php
              }
         ?>
        <img id="product_img1" src="<?php echo $row['Image']; ?>" alt="">
      </div>

      <div id="product_info">
        <div id="product_name">
        <p>Name:<p id="pro_name"><?php echo $row['Name']; ?></p></p>
        </div>
        <p id="product_variant">Variant:</p>
        <div id="variant">
          <p id="variant1"><?php echo $row['Weight']; ?></p>
        </div>
        <p id="section">________________________________________________________________________________________________________</p>
        <div id="product_mrp">
          <p id="pro_mrp">MRP <?php echo $row['MRP']; ?></p>
          <p>(Inclusive of all taxes)</p>
        </div>
        <div id="product_dmart">
          <p id="pro_dmart">Dmart<?php
                                if ($row['Buy_1_Get_1'] == "Yes") {
                                    $newprice = $row['Dmart'] / 2;
                                ?>
                                    <p id="pro_dmart_price"><?php echo $newprice; ?></p>
                                <?php
                                } else {
                                ?>
                                    <p id="pro_dmart_price"><?php echo $row['Dmart']; ?></p>
                                <?php
                                }
                                ?></p>
        </div>
        <p id="section">________________________________________________________________________________________________________</p>
        <div id="price_save">
          <p id="save">SAVE  <?php
                                if ($row['Buy_1_Get_1'] == "Yes") {
                                ?>
                                    <p id="save_price"><?php echo $newprice + $row['Save']; ?></p>
                                    <?php
                                    $newprice = 0;
                                    ?>
                                <?php
                                } else {
                                ?>
                                    <p id="save_price"><?php echo $row['Save']; ?></p>
                                <?php
                                }
                                ?></p>
        </div>

        <button id="pro_cart"  value="ADD TO CART" style="background-color: rgba(43, 194, 76, 0.47);" name="ADD_TO_CART">
          <img id="pro_cart_img" src="./img/product/cart_green.jpg" alt="">
          <p id="pro_cart_msg">Add To Cart</p>
          
          <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>" />
          <input type="hidden" name="product_image" value="<?php echo $row['Image']; ?>" />
          <?php
                            if ($row["Buy_1_Get_1"] == "Yes") {
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
                                if($row["Buy_1_Get_1"] == "Yes")
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
        </div>
      </div>
    </div>
  </form>

  <div id="all_info">
    <div id="description">
      <p id="product_description">DESCRIPATION</p>
    </div>
    <div id="pro_description"><?php echo $row['Discripation'] ?></div>
  </div>
</body>

</html>

<?php
include("footer.php");
?>