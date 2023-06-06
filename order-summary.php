<?php
session_start();

if(!isset($_SESSION['user'])){
    header("location:login.php");
    die();
}

include 'db_conn.php';
if(isset($_GET['id'])){
    $productid = $_GET['id'];
    $sql = "SELECT * from sales_items where id=$productid AND status='available'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $product = $result->fetch_assoc();
        $sellerid = $product['user_id'];
        $sql = "SELECT * from users where id='$sellerid'";
        $result = $conn->query($sql);
        $seller = $result->fetch_assoc();
    }else{
        header("location:shop.php");
        die();
    }
}

if(isset($_POST['transaction_id'])){
    $transaction_id =  $_POST['transaction_id'];
    $purchase_type = 'paypal';
    if(empty($transaction_id)){
        $msg = "<div class='alert alert-danger'>Transaction id is required!</div>";
    }else{
        $userid = $_SESSION['user'];
        $sql = "SELECT * from users where id='$userid'";
        $result = $conn->query($sql);
        $buyer = $result->fetch_assoc();
        $full_name = $buyer['name'];
        $email = $buyer['email'];

        
        $sql = "INSERT INTO items_sold(item_id,purchase_type,transaction_id, full_name, email) 
           VALUES ('$productid','$purchase_type','$transaction_id','$full_name','$email')";
        if($conn->query($sql)===TRUE){
            $sql = "update sales_items set status='sold' where id=$productid";
            if($conn->query($sql)===TRUE){
                
                //Seller Message
                $message = '<b>Dear Seller,</b> 
                <br>Your item has been sold by paypal.
                <br><br><b>Item Details:</b><br>
                Item Name: '.$product['title'].'<br>
                Item Description: '.$product['description'].'<br>
                Item Picture: <br> <img style="width:250px;height:350px;object-fit:cover" src="'.$url.'/img/'.$product['picture'].'">
                
                <br><br><b>Buyer Details:</b> <br>
                Name: '.$buyer['name'].'<br>
                Email: '.$buyer['email'].'<br><br>
                <b>Thanks</b>';
                
                $subject = 'Item Sold';
                sendMail($subject, $seller['email'], $message, $attachment='');
                
                //Buyer Message
                $message = '<b>Dear Buyer,</b> 
                <br>You have purchased an item via paypal.
                <br><br><b>Item Details:</b><br>
                Item Name: '.$product['title'].'<br>
                Item Description: '.$product['description'].'<br>
                Item Picture: <br> <img style="width:250px;height:350px;object-fit:cover" src="'.$url.'/img/'.$product['picture'].'">
                
                <br><br><b>Seller Details:</b> <br>
                Name: '.$seller['name'].'<br>
                Email: '.$seller['email'].'<br><br>
                <b>Thanks</b>';
                
                $subject = 'Item Purchased';
                sendMail($subject, $buyer['email'], $message, $attachment='');
                
                $sql = "SELECT a.*, b.email from trade_items as a left join users as b on a.user_id=b.id where a.item_id='$productid'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $trade_proposer = $row['user_id'];
                        $message = '<b>Dear Buyer,</b> <br>The item is no longer available for which you had sent a trade proposal.
                        <br><br><b>Item Details:</b> <br>
                        Item Name: '.$product['title'].'<br>
                        Item Description: '.$product['description'].'<br>
                        Item Picture: <br> <img style="width:250px;height:350px;object-fit:cover" src="'.$url.'/img/'.$product['picture'].'">

                        <br><br><b>Trade Details:</b> <br>
                        Item Name: '.$row['item_name'].'<br>
                        Description: '.$row['description'].'<br>
                        Item Picture: <br> <img style="width:250px;height:350px;object-fit:cover" src="'.$url.'/img/'.$row['image'].'">
                        <b></b> <br>

                        <b>Thanks</b>.';
                        $subject = "Item no longer available";
                        sendMail($subject, $row['email'], $message, $attachment="");
                        $sql = "delete from trade_items where id='{$row['id']}'";
                        $conn->query($sql);
                    }
                }
                
                
                header("location:shop.php?item_sold=1");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Order Summary | 2WEAR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="css/order-summary.css">
    <script src="JS/order-summary.js"></script>
    

</head>

<body>
    
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <h1>2WEAR</h1>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <img class="similiar-image" src="img/<?php echo $product['picture']; ?>" alt="Item Image">
            <p><strong>Price:</strong> <?php echo $product['price']; ?> NIS</p>
            <p><strong>Size:</strong> <?php echo $product['size']; ?></p>
            <p><strong>Condition:</strong> <?php echo $product['condition_item']; ?></p>
            <p><strong>Gender:</strong> <?php echo $product['gender']; ?></p>
            <p><strong>Location:</strong> <?php echo $seller['street']; ?>, <?php echo $seller['city']; ?></p>
            <p class="text-danger fw-bold">
                Please confirm the terms of use before making the payment.
            </p>
            <div class="form-check" onclick="showPaypal()">
                <input class="form-check-input" type="checkbox" value="" id="accept-marketing">
                <label class="form-check-label checkbox-label" for="accept-marketing">
                    Accept marketing content
                </label>
            </div>
            <div class="form-check" onclick="showPaypal()">
                <input class="form-check-input" type="checkbox" value="" id="confirm-terms">
                <label class="form-check-label checkbox-label" for="confirm-terms">
                    Confirm terms of use
                </label>
            </div>
            <div class="row justify-content-center mt-5" style="display:none" id="paypal-div">
               
                <div class="col-md-6">
                    <form action="" method="post" id="order-form">
                        <input type="hidden" name="transaction_id" id="transactionid">
                    </form>
                    <div id="paypal-button"></div>
                </div>
            </div>
            
        </div>
    </div>

    <footer class="bg-dark" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">2WEAR Shop</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            Dizengoff 123 Tel-Aviv
                        </li>
                        <li>
                            <a class="text-decoration-none" href="tel:012-345-6789">012-345-6789</a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="mailto:2wearclothings@gmail.com">2wearclothings@gmail.com</a>
                        </li>
                    </ul>
                </div>
    
               <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="index.php">Home</a></li>
                        <li><a class="text-decoration-none" href="about.php">About Us</a></li>
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            © Ron Gohar & Bar Reuven & Stav Cohen & Gal Baron | 2023
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://www.paypal.com/sdk/js?client-id=AfPnZ7Hnonuf-NMM6Q6f7U8nhk84i2Ei4fSI56eqAh0Gj74fYQ36qfCBtj9B2oJPULQLWjz5_EVgA5yy&currency=ILS&disable-funding=credit"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        var item_price = "<?php echo $product['price']; ?>";
    </script>
    <script src="JS/order-summary.js"></script>

</body>
</html>