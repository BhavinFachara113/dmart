<?php
include("config.php");
session_start();
error_reporting(0);
?>
<?php
  if(isset($_GET["btn_delete"]))
  {
    $id=$_GET['btn_delete'];
    $delete="DELETE FROM cookware where Id='$id';";
    $s=$c->query($delete);
  }
?>

<?php
  if(isset($_GET['btn_approved']))
  {
    $id=$_GET['btn_approved'];
    $s=1;
    $approved="UPDATE cookware SET Status='$s' where Id='$id';";
    $a=$c->query($approved);
  }
?>

<?php
  if(isset($_GET['btn_reject']))
  {
    $id=$_GET['btn_reject'];
    $s=0;
    $reject="UPDATE cookware SET Status='$s' where Id='$id';";
    $a=$c->query($reject);
  }
?>

<?php
include("sidebar.php");
?>
<html>

<head></head>
<link  rel="stylesheet" href="./css/ready_to_cook1.css">
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

<body>
    <?php
    include("navigation.php");
    ?>
    <div id="product_data_display" style="background-image: url('./img/img2.jpg'); 
    background-size: cover;">
     <div id="product_add_new_data"> <a href="./add_cookware.php" id="product_add_new_data_msg"><img id="product_add_new_data_img" src="./img/add1.jpg" alt="">ADD NEW</a></div>
      <table id="product_data_display_table">
       <tr>
           <th id="product_data_display_table_th">Name</th>
           <th id="product_data_display_table_th">Sort Name</th>
           <th id="product_data_display_table_th">Brand Name</th>
           <th id="product_data_display_table_th">Image</th>
           <th id="product_data_display_table_th">Variant</th>
           <th id="product_data_display_table_th">MRP</th>
           <th id="product_data_display_table_th">Damrt</th>
           <th id="product_data_display_table_th">Save</th>
           <th id="product_data_display_table_th_buy">BUY 1 GET 1</th>
           <th id="product_data_display_table_th">Quantity</th>
           <th id="product_data_display_table_th">Discripation</th>
           <th id="product_data_display_table_th">Status</th>
           <th id="product_data_display_table_th">Option</th>
       </tr>
       <?php
         $select="select* from cookware";
         $data=$c->query($select);
         while($row=$data->fetch_assoc())
         {
            ?>
           <tr>
               <td id="product_data_display_td_name"><?php echo $row['Name'];?></td>
               <td id="product_data_display_td"><?php echo $row['Sort_Name'];?></td>
               <td id="product_data_display_td"><?php echo $row['Brand_Name'];?></td>
               <td id="product_data_display_td"><?php echo $row['Image'];?></td>
               <td id="product_data_display_td"><?php echo $row['Variant'];?></td>
               <td id="product_data_display_td"><?php echo $row['MRP'];?></td>
               <td id="product_data_display_td"><?php echo $row['Dmart'];?></td>
               <td id="product_data_display_td"><?php echo $row['Save'];?></td>
               <td id="product_data_display_td"><?php echo $row['Buy_1_Get_1'];?></td>
               <td id="product_data_display_td"><?php echo $row['Quantity'];?></td>
               <td id="product_data_display_td"><?php echo "discripation" ;?></td>
               <td id="product_data_display_td"><?php echo $row['Status'];?></td>
               <td id="product_data_display_td"><a href="edit_cookware.php?btn_edit=<?php echo $row['Id'];?>"><img id="product_data_display_td_option_updata" src="./img/updata1.jpg" alt=""></a><a href="cookware.php?btn_delete=<?php echo $row['Id'];?>"><img id="product_data_display_td_option_delete" src="./img/delete.jpg" alt=""></a><a href="cookware.php?btn_approved=<?php echo $row['Id'];?>"><img id="product_data_display_td_option_appoved" src="./img/appoved.jpg" alt=""></a><a href="cookware.php?btn_reject=<?php echo $row['Id'];?>"><img id="product_data_display_td_option_reject" src="./img/reject.jpg" alt=""></a></td>
           </tr>
           <?php
         }
        ?>       
      </table>
    </div>
    <?php
    include("setting.php");
    ?>

</body>

</html>

<?php

?>