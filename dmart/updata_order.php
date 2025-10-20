<?php
include("navigationbar.php");
include("config.php");

if (isset($_GET['btn_update'])) 
{
    $id = $_GET['btn_update'];
    $select = "SELECT * FROM user_order WHERE id=$id";
    $data = $c->query($select);
    $row = $data->fetch_assoc();

    $upi = null;
    $credit_card = null;
    if ($row['payment'] == 'unpaid') 
    {
        $cash_on_delivery = "yes";
    } 
    else 
    {
         $cash_on_delivery = "no";
        if ($row['payment method'] == 'UPI') 
        {
            $upi = $row['payment'];
        }
        else 
        {
            $credit_card = $row['payment'];
        }
    }
}

if (isset($_POST['update_order'])) 
{
    // Get form data
    $cash = isset($_POST['cash_delivery']) ? $_POST['cash_delivery'] : null;
    $upi_id = !empty($_POST['upi_id']) ? $_POST['upi_id'] : null;
    $credit_card = !empty($_POST['credit_card']) ? $_POST['credit_card'] : null;

    $name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $full_address = $address;

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

        $id = $_GET['btn_update'];
        $update = "UPDATE user_order SET name='$name',phone=$phone,address='$address',payment='$payment_status',email='$email' WHERE id='$id'";
        $data = $c->query($update);
        
        if ($data) 
        {
            echo "<script>alert('Order Updated Successfully'); window.location.href='./index.php'</script>";
        } 
        else 
        {
            echo "<script>alert('Order Cannot Be Updated');</script>";
        }
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="./css/bill.css">
    <script>
        function togglePaymentFields() {
            var codYes = document.getElementById('bill_detail_payment_cash_button_yes');
            var codNo = document.getElementById('bill_detail_payment_cash_button_no');
            var upiField = document.getElementById('bill_detail_payment_upi');
            var creditCardField = document.getElementById('bill_detail_payment_credit');
            var orLabel1 = document.getElementById('bill_detail_payment_or1');
            var orLabel2 = document.getElementById('bill_detail_payment_or2');

            if (codYes.checked) {
                upiField.style.display = 'none';
                creditCardField.style.display = 'none';
                orLabel1.style.display = 'none';
                orLabel2.style.display = 'none';
            } else if (codNo.checked) {
                upiField.style.display = 'block';
                creditCardField.style.display = 'block';
                orLabel1.style.display = 'block';
                orLabel2.style.display = 'block';
            }
        }

        window.onload = function() {
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
                    <input type="text" id="bill_detail_add_name" name="full_name" value="<?php echo $row['name'] ?>" required>
                    <label for="bill_detail_add_phone">Phone No:</label>
                    <input type="text" id="bill_detail_add_phone" name="phone" value="<?php echo $row['phone'] ?>" required>
                </div>

                <div>
                    <label for="bill_detail_add_state">Email:</label>
                    <input type="text" id="bill_detail_add_email" name="email" value="<?php echo $row['email'] ?>" required>
                </div>

                <div>
                    <label for="bill_detail_full_add">Address:</label>
                    <input type="text" id="bill_detail_full_add" name="address" value="<?php echo $row['address'] ?>" placeholder="Enter Full Address Including Street Name, Apartment Name, Near By Place" required>
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
                <input type="text" id="bill_detail_payment_upi_id_input" name="upi_id" value="<?php echo $upi; ?>">
            </div>
            <div id="bill_detail_payment_or2" style="margin-left: 230px;margin-top:10px;">
                <label for="">or</label>
            </div>
            <div id="bill_detail_payment_credit">
                <label for="bill_detail_payment_credit_card_number">Credit Card:</label>
                <input type="text" id="bill_detail_payment_credit_card_number" name="credit_card" value="<?php echo $credit_card; ?>">
            </div>
        </div>
    </div>

    <center>
        <div id="bill_detail_place">
            <input type="submit" id="bill_detail_place_order" name="update_order" value="Update Order">
        </div>
    </center>
    </form>
</div>
</body>
</html>

<?php include("footer.php"); ?>
