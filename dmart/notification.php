<?php
include('navigationbar.php');
include('config.php');
?>

<?php
   if(isset($_SESSION['any']))
   {
      $user=$_SESSION['any'];
   }
   else
   {
    echo '<p style="color: red; font-weight: bold;">You need to log in first!</p>';
    header("Location: login.php?message=need_login");
    exit();
   }

   if(isset($_GET["btn_delete"]))
   {
     $id=$_GET['btn_delete'];
     $delete="DELETE FROM user_order where id='$id';";
     $s=$c->query($delete);
   }
?>

<html>
<head>
<link rel="stylesheet" href="./css/notification.css">
</head>
<body>
        <div id="main">
         <div id="display">
          <table id="display_table">
            <tr id="display_table_tr">
                <th id="display_table_tr_td">Name</th>
                <th id="display_table_tr_td">Product</th>
                <th id="display_table_tr_td">Address</th>
                <th id="display_table_tr_td">Phone</th>
                <th id="display_table_tr_td">Price</th>
                <th id="display_table_tr_td">Save</th>
                <th id="display_table_tr_td">Payment</th>
                <th id="display_table_tr_td">Payment Method</th>
                <th id="display_table_tr_td">Email</th>
                <th id="display_table_tr_td">Opation</th>
            </tr>
           <?php
              $select="select * from user_order where email='$user'";
              $data=$c->query($select);
              while($row=$data->fetch_assoc())
              {
                ?>
                <tr id="display_table_tr">
                  <td id="display_table_tr_td"><?php echo$row['name'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['product'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['address'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['phone'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['price'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['save'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['payment'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['payment method'] ?></td>
                  <td id="display_table_tr_td"><?php echo$row['email'] ?></td>
                  <td id="display_table_tr_td">
                  <a href="./notification.php?btn_delete=<?php echo $row['id']; ?>"  id="display_table_tr_updata_button"><div id="display_table_tr_button">Cancel</div></a> 
                  <a href="./updata_order.php?btn_update=<?php echo $row['id']; ?>" id="display_table_tr_updata_button">
                  <div id="display_table_tr__div_updata_button">Update</div>
                  </a>
                  </td>
                </tr>

               <?php
              }
           ?>
          </table>
         </div>
        </div>        
</body> 
</html>
<?php
include('footer.php');
?>