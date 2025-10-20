<?php
include("navigationbar.php");
include("config.php");

if (isset($_SESSION['cart'])) 
{
    if (isset($_SESSION['any'])) 
    {
       
    } 
    else
    {
        echo "<script>alert('You Need To Login'); window.location.href='./login.php'</script>";
        exit;
    }
} 
else 
{
    echo "<script>alert('You Need To Add Some Product'); window.location.href = './index.php'</script>";
    exit;
}


if (isset($_POST['place_order'])) 
{
    $cash = isset($_POST['cash_delivery']) ? $_POST['cash_delivery'] : null;
    $upi_id = !empty($_POST['upi_id']) ? $_POST['upi_id'] : null;
    $credit_card = !empty($_POST['credit_card']) ? $_POST['credit_card'] : null;

    $name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $address = $_POST['address'];
    $email= $_POST['email'];
    $full_address = $address . ", " . $city . ", " . $pin_code . ", " . $state;
    $delivery=50;

    $values = $_SESSION['cart'];

    if (($cash === "Yes" && ($upi_id || $credit_card)) || ($upi_id && $credit_card)) 
    {
        echo "<script>alert('Select Only One Payment Method');</script>";
    } 
    else 
    {
        $payment_method = "";
        $payment_status = "unpaid";
        
        if ($cash === "Yes") 
        {
            $payment_method = "cash on delivery";
        } 
        elseif ($upi_id) 
        {
            $payment_method = "UPI";
            $payment_status = $_POST['upi_id'];
        } 
        elseif ($credit_card) 
        {
            $payment_method = "credit card";
            $payment_status = $_POST['credit_card'];
        } 
        else 
        {
            echo "<script>alert('Select One Payment Method');</script>";
            exit;
        }
    }
}

if(isset($_POST['place_order']))
{
    $product=$_POST['product'];
    $price=$_POST['price'];
    $save=$_POST['save'];
    $insert="insert into user_order values('','$name','$product',$phone,'$full_address',$price,$save,'$payment_status','$payment_method','$email')";
    $data = $c->query($insert);

    if ($data) 
    {
        echo "<script>alert('Order Placed Successfully'); window.location.href='./index.php'</script>";
    } 
    else 
    {
        echo "<script>alert('Order Cannot Be Placed');</script>";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="./css/bill.css">
    <script>
        function togglePaymentFields() 
        {
            var codYes = document.getElementById('bill_detail_payment_cash_button_yes');
            var codNo = document.getElementById('bill_detail_payment_cash_button_no');
            var upiField = document.getElementById('bill_detail_payment_upi');
            var creditCardField = document.getElementById('bill_detail_payment_credit');
            var orLabel1 = document.getElementById('bill_detail_payment_or1');
            var orLabel2 = document.getElementById('bill_detail_payment_or2');

            if (codYes.checked) 
            {
                upiField.style.display = 'none';
                creditCardField.style.display = 'none';
                orLabel1.style.display = 'none';
                orLabel2.style.display = 'none';
            } 
            else if (codNo.checked) 
            {
                upiField.style.display = 'block';
                creditCardField.style.display = 'block';
                orLabel1.style.display = 'block';
                orLabel2.style.display = 'block';
            }
        }

        window.onload = function() 
        {
            togglePaymentFields();
        }
    </script>
</head>
<body>
<div id="bill_detail">
    <div id="bill_detail_add">
        <h1 id="bill_detail_add_heading">
            <p id="bill_detail_add_heading_msg1">1.</p>
            <img id="bill_detail_add_heading_img" src="./img/address.jpg" alt="">
            <p id="bill_detail_add_heading_msg2">ADDRESS</p>
        </h1>
        <div id="bill_detail_add_form">
            <form action="" method="post">
                <div>
                    <label for="bill_detail_add_name">Full Name:</label>
                    <input type="text" id="bill_detail_add_name" name="full_name" required>
                    <label for="bill_detail_add_phone">Phone No:</label>
                    <input type="text" id="bill_detail_add_phone" name="phone" required>
                </div>

                <div>
                    <label for="bill_detail_add_city">City:</label>
                    <input type="text" id="bill_detail_add_city" name="city" required>
                    <label for="bill_detail_add_state">State:</label>
                    <input type="text" id="bill_detail_add_state" name="state" required>
                </div>

                <div>
                    <label for="bill_detail_full_pin">Pin Code:</label>
                    <input type="text" id="bill_detail_full_pin" name="pin_code" required>
                    <label for="bill_detail_add_state">email:</label>
                    <input type="text" id="bill_detail_add_email" name="email" required>
                </div>

                <div>
                    <label for="bill_detail_full_add">Address:</label>
                    <input type="text" id="bill_detail_full_add" name="address" placeholder="Enter Full Address Including Street Name, Apartment Name, Near By Place" required>
                </div>
        </div>
    </div>

    <div id="bill_detail_payment">
        <h1 id="bill_detail_add_heading">
            <p id="bill_detail_add_heading_msg1">2.</p>
            <img id="bill_detail_add_heading_img" src="./img/payment.jpg" alt="">
            <p id="bill_detail_add_heading_msg2">PAYMENT</p>
        </h1>
        <div id="bill_detail_add_form">
            <div style="display: flex; margin-top:10px; margin-left: 20px; margin-right: 20px;">
                <p id="bill_detail_payment_cash">Cash On Delivery:</p>
                <label for="bill_detail_payment_cash_button_yes" style="margin-top: 5px;">Yes</label>
                <input type="radio" name="cash_delivery" value="Yes" id="bill_detail_payment_cash_button_yes" onclick="togglePaymentFields()">
                <label for="bill_detail_payment_cash_button_no" style="margin-top: 5px;">No</label>
                <input type="radio" name="cash_delivery" value="No" style="margin-top: 5px;margin-left:5px;" id="bill_detail_payment_cash_button_no" onclick="togglePaymentFields()">
            </div>
            <div id="bill_detail_payment_or1" style="margin-left: 230px;margin-top:10px;">
                <label for="">or</label>
            </div>
            <div id="bill_detail_payment_upi">
                <label for="bill_detail_payment_upi_id_input">UPI:</label>
                <input type="text" id="bill_detail_payment_upi_id_input" name="upi_id" placeholder="Enter Your UPI Id">
            </div>
            <div id="bill_detail_payment_or2" style="margin-left: 230px;margin-top:10px;">
                <label for="">or</label>
            </div>
            <div id="bill_detail_payment_credit">
                <label for="bill_detail_payment_credit_card_number">Credit Card:</label>
                <input type="text" id="bill_detail_payment_credit_card_number" name="credit_card" placeholder="XXXX XXXX XXXX XXXX">
            </div>
        </div>
    </div>

    <center>
        <div id="bill_detail_place">
            <input type="submit" id="bill_detail_place_order" name="place_order" value="Place Order">
            <input type="hidden" name="product" value="<?php echo$_POST['product_names'];?>">
            <input type="hidden" name="price" value="<?php echo$_POST['cart_total'];?>">
            <input type="hidden" name="save" value="<?php echo$_POST['savings'];?>">
        </div>
    </center>
    </form>
</div>
</body>
</html>

<?php
include("footer.php");
?>
