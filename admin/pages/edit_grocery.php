<?php
include("config.php");
?>
<?php
$msg = "";
if (isset($_POST['add_product'])) {
    $id = $_GET['btn_edit'];
    $name = $_POST['p_name'];
    $sname = $_POST['p_sort_name'];
    $brand = $_POST['p_brand'];
    $image = $_POST['p_image'];
    $weight = $_POST['p_weight'];
    $mrp = $_POST['p_mrp'];
    $dmart = $_POST['p_dmart'];
    $save = $mrp - $dmart;
    $buy_1_get_1 = $_POST['p_buy_1_get_1'];
    $quentity = $_POST['p_quantity'];
    $discripation = $_POST['p_discripation'];
    $status = $_POST['p_status'];
    echo $buy_1_get_1;
    $insert = "UPDATE grocery SET Name='$name', Sort_Name='$sname', Brand_Name='$brand', Image='$image', Weight='$weight', MRP='$mrp', Dmart='$dmart', Save='$save', Buy_1_Get_1='$buy_1_get_1', Quantity='$quentity', Discripation='$discripation' ,Status='$status' where Id='$id'";
    $s = $c->query($insert);
?>
    <script>
        window.location.href = "grocery.php";
    </script>
<?php
}
?>

<?php
include("sidebar.php");
?>
<html>

<head></head>
<link rel="stylesheet" href="./css/add_ready_to_cook.css">
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<!-- CSS Files -->
<link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
<link href="./css/add_ready_to_cook.css" rel="stylesheet">

<body>
    <?php
    include("navigation.php");
    ?>
    <div id="new_product" style=" background-image: url('./img/img.jpg'); 
    background-size: cover;">

        <?php
        $id = $_GET['btn_edit'];
        $select = "select * from grocery where Id='$id';";
        $result = $c->query($select);
        $row = $result->fetch_assoc();

        ?>
        <form id="new_product_form" action="" method="post">
            <p id="new_product_form_msg">ADD NEW PRODUCT IN READY TO COOK </p>
            <label id="new_product_form_label_name" for="">Product Name:</label>
            <input id="new_product_form_sort_name" type="text" value="<?php echo $row['Name']; ?>" name="p_name" required>
            <label id="new_product_form_label_sort_name" for="">Sort Name:</label>
            <input id="new_product_form_sort_name" type="text" value="<?php echo $row['Sort_Name']; ?>" name="p_sort_name" required><br>
            <label for="" id="new_product_form_label_brand">Brand Name:</label>
            <input type="text" id="new_product_form_brand" value="<?php echo $row['Brand_Name']; ?>" name="p_brand" required>
            <label for="" id="new_product_form_label_weight">Weight:</label>
            <input type="text" id="new_product_form_weight" value="<?php echo $row['Weight']; ?>" name="p_weight" required><br>
            <label for="" id="new_product_form_label_image">Image:</label>
            <input id="new_product_form_image" type="text" value="<?php echo $row['Image']; ?>" name="p_image" required><br>
            <label for="" id="new_product_form_lable_buy">BUY 1 GET 1:</label>
            <?php
            if ($row['Buy_1_Get_1'] == "Yes")
             {
               ?>

                <input type="radio" name="p_buy_1_get_1" id="new_product_form_buy"  value="Yes" onload="select()" checked="true" required>YES
                <input type="radio" name="p_buy_1_get_1" id="new_product_form_buy" value="No" onload="select()" required>NO <br>
               <?php
            }

            else
            {
                 ?>
                 
            <input type="radio" name="p_buy_1_get_1" id="new_product_form_buy"  value="Yes" onload="select()" required>YES
            <input type="radio" name="p_buy_1_get_1" id="new_product_form_buy"  value="No" onload="select()" checked = "true" required>NO <br>
            <?php
            }
            ?>
            <label id="new_product_form_label_mrp" for="">MRP:</label>
            <input id="new_product_form_mrp" type="number" value="<?php echo $row['MRP']; ?>" name="p_mrp" required>
            <label id="new_product_form_label_dmart" for="">Dmart:</label>
            <input id="new_product_form_dmart" type="number" value="<?php echo $row['Dmart']; ?>" name="p_dmart" required><br>
            <label for="" id="new_product_form_lable_quentity">Quantity:</label>
            <input type="number" id="new_product_form_quentity" value="<?php echo $row['Quantity']; ?>" name="p_quantity" required>
            <label for="" id="new_product_form_label_Status">Status:</label>
            <input id="new_product_form_Status" type="number" value="<?php echo $row['Status']; ?>" name="p_status" required><br>
            <label for="" id="new_product_form_lable_discripation">Discripation:</label><br>
            <textarea id="new_product_form_discripation" name="p_discripation" required><?php echo $row['Discripation']; ?></textarea><br><br>
            <input type="submit" id="new_product_form_add_product" name="add_product" value="Update Product"><br>
            <div id="new_product_form_back"><a id="new_product_form_back_msg" href="./grocery.php"><img id="new_product_form_back_img" src="./img/back.jpg" alt=""> Back</a></div>
        </form>
    </div>
    <?php
    include("setting.php");
    ?>
</body>

</html>

<?php

?>