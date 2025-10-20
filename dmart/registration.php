<?php
include("config.php");
include("navigationbar.php");
?>

<?php
   if(isset($_POST["registration"]))
   {
      $name=$_POST['u_name'];
      $phone=$_POST['u_phone_number'];
      $email=$_POST['u_email'];
      $password=$_POST['u_password'];

      $insert="insert into user values('','$email',$password,'$name','$phone')";
      if( $c->query($insert))
      {
        ?>
                 <script>
                    window.location.href = "index.php";
                </script>
        <?php
      }
      else
      {
        $mesg="Invalied Data";
      }

   }
?>
<html>

<head>
    <link rel="stylesheet" href="./css/registration.css">
</head>

<body>
    <div id="login_selction1">
        <div id="login_selction2">
            <div id="login_image">
                <img id="login_img" src="./img/img1.png" alt="">
            </div>

            <div id="login_form">
                <img id="login_form_logo" src="./img/logo.jpg" alt="">
                <center>
                    <p id="login_form_msg1">Welcome!</p>
                </center>
                <center>
                    <p id="login_form_msg2">You are currently browsing as a guest.</p>
                </center>
                <center>
                    <p id="login_form_msg3"> Registration to save your preferences and orders.</p>
                </center>
                <form method="post">
                    <label id="login_form_lab_u_name">User Name</label>
                    <input id="login_form_input_u_name" type="text" name="u_name" placeholder="Enter Your Name"><br>
                    
                    <label id="login_form_lab_u_password">Phone Number</label>
                    <input id="login_form_input_u_phone" type="text" name="u_phone_number" placeholder="Enter Your Phone Number"><br>
                    
                    <label id="login_form_lab_u_password">Email</label>
                    <input id="login_form_input_u_email" type="text" name="u_email" placeholder="Enter Your Email"><br>
                    
                    <label id="login_form_lab_u_password">Password</label>
                    <input id="login_form_input_u_password" type="text" name="u_password" placeholder="Enter Your Password"><br>
                    
                    <input id="login_form_button_login" type="submit" name="registration" value="Registration">
                    <p id="login_form_p_msg1">or</p>
                    <p id="login_form_p_msg2">If You Have An Account Then Go To <a href="login.php" id="login_form_button_Registeration">Login</a></p><br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include("footer.php");
?>