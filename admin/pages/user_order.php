<?php
include("config.php");
session_start();
error_reporting(0);
?>
<?php
  if(isset($_GET["btn_delete"]))
  {
    $id=$_GET['btn_delete'];
    $delete="DELETE FROM user where Id='$id';";
    $s=$c->query($delete);
  }


  if(isset($_POST['btn_compalite']))
  {
     $order_id=$_POST['order_id'];
     
     $insert="INSERT INTO sales (id, name,product,address,phone,price,save)SELECT id,name,product,address,phone,price,save FROM user_order where id=$order_id;";
     $data1=$c->query($insert);

     $delete="DELETE FROM user_order WHERE id=$order_id";
     $data2=$c->query($delete);
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
      <table id="product_data_display_table">
       <tr>
           <th id="product_data_display_table_th">Id</th>
           <th id="product_data_display_table_th">Name</th>
           <th id="product_data_display_table_th">Product</th>
           <th id="product_data_display_table_th">Phone</th>
           <th id="product_data_display_table_th">Address</th>
           <th id="product_data_display_table_th">Price</th>
           <th id="product_data_display_table_th">Save</th>
           <th id="product_data_display_table_th">Payment</th>
           <th id="product_data_display_table_th">Payment Method</th>
           <th id="product_data_display_table_th">Email</th>
           <th id="product_data_display_table_th">Order Compilation</th>
       </tr>
       <?php
         $select="select* from user_order";
         $data=$c->query($select);
         while($row=$data->fetch_assoc())
         {
            ?>
           <tr>
              <form action="user_order.php" method="post">
               <td id="product_data_display_td_name"><?php echo $row['id'];?></td>
               <td id="product_data_display_td"><?php echo $row['name'];?></td>
               <td id="product_data_display_td"><?php echo $row['product'];?></td>
               <td id="product_data_display_td"><?php echo $row['phone'];?></td>
               <td id="product_data_display_td"><?php echo $row['address'];?></td>
               <td id="product_data_display_td"><?php echo $row['price'];?></td>
               <td id="product_data_display_td"><?php echo $row['save'];?></td>
               <td id="product_data_display_td"><?php echo $row['payment'];?></td>
               <td id="product_data_display_td"><?php echo $row['payment method'];?></td>
               <td id="product_data_display_td"><?php echo $row['email'];?></td>
               <td id="product_data_display_td"><input type="submit" name="btn_compalite" id="product_data_display_td_button" value="Compalite"></input></td>
               <input type="hidden" name="order_id" value="<?php echo$row['id'];?>"/>
              </form>
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