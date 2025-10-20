<?php
include("config.php");
include("navigationbar.php");
error_reporting(0);
?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST["u_name"];
    $password = $_POST["u_password"];

    $select = "select * from User";
    $data = $c->query($select);
    while ($row = $data->fetch_assoc()) {
        if ($row["User_Name"] == $username) {
            if ($row["User_Password"] == $password) {
                $_SESSION['any']=$row['User_Name'];
                ?>
                <script>
                    window.location.href = "index.php";
                </script>
                <?php
            } else {
                $mesg = "Invalid User Name Or Password";
            }
        }
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="./css/login1.css">
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
                    <p id="login_form_msg3"> Sign in to save your preferences and orders.</p>
                </center>
                <form method="post">
                    <center><p style="color: red;"><?php echo$mesg; ?></p></center>
                    <label id="login_form_lab_u_name">User Name</label>
                    <input id="login_form_input_u_name" type="email" name="u_name" placeholder="Enter Your Name"><br>
                    <label id="login_form_lab_u_password">Password</label>
                    <input id="login_form_input_u_password" type="text" name="u_password" placeholder="Enter Your Password"><br>
                    <input id="login_form_button_login" type="submit" name="login" value="Login">
                    <p id="login_form_p_msg1">or</p>
                    <p id="login_form_p_msg2">If You Dose Not Have An Account Then Go To <a href="registration.php" id="login_form_button_Registeration">Registeration</a></p><br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include("footer.php");
?>