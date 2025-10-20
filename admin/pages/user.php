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
           <th id="product_data_display_table_th">Name</th>
           <th id="product_data_display_table_th">Email Address</th>
           <th id="product_data_display_table_th">Password</th>
           <th id="product_data_display_table_th">Phone Number</th>
           <th id="product_data_display_table_th">Delete User</th>
       </tr>
       <?php
         $select="select* from user";
         $data=$c->query($select);
         while($row=$data->fetch_assoc())
         {
            ?>
           <tr>
               <td id="product_data_display_td_name"><?php echo $row['Name'];?></td>
               <td id="product_data_display_td"><?php echo $row['User_Name'];?></td>
               <td id="product_data_display_td"><?php echo $row['User_Password'];?></td>
               <td id="product_data_display_td"><?php echo $row['Phone_Number'];?></td>
               <td id="product_data_display_td"><a href="user.php?btn_delete=<?php echo $row['id'];?>"><img id="product_data_display_td_option_delete" src="./img/delete.jpg" alt=""></a></td>
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