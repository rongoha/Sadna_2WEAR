<?php
session_start();
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

if(isset($_POST['sumbit-trade'])){
    $item_name =  $_POST['item_name'];
    $item_description =  $_POST['item_description'];
    $item_img =  "";
    $token = uniqid(time());
    
    if(!empty($_FILES["item_img"]["name"])){
        $path_parts = pathinfo($_FILES["item_img"]["name"]);
        $extension = $path_parts['extension'];
        $extension = strtolower($extension);
        if($extension=='png' || $extension=='jpg' || $extension=='jpeg' || $extension=='gif'){
            $item_img = uniqid(time()).".$extension";
            $item_img_tmp = $_FILES['item_img']['tmp_name'];
        }
    }
    
    if(empty($item_name) || empty($item_description)|| empty($item_img)){
        $msg = "<div class='alert alert-danger'>Please enter all the requested fields!</div>";
    }else{
        $userid = $_SESSION['user'];
        $sql = "SELECT * from users where id='$userid'";
        $result = $conn->query($sql);
        $buyer = $result->fetch_assoc();
        
        $sql = "INSERT INTO trade_items(user_id,item_name,description,image, item_id, token) 
           VALUES ('$userid','$item_name','$item_description','$item_img', '$productid','$token')";
        if($conn->query($sql)===TRUE){
            move_uploaded_file($item_img_tmp, "img/$item_img");
            $message = '<b>Dear Seller,</b> <br>You have received a trade offer for your item.
            <br><br><b>Item Details:</b> <br>
            Item Name: '.$product['title'].'<br>
            Item Description: '.$product['description'].'<br>
            Item Picture: <br> <img style="width:350px;height:250px;object-fit:cover" src="'.$url.'/img/'.$product['picture'].'">
            
            <br><br><b>Trade Details:</b> <br>
            Customer Name: '.$buyer['name'].'<br>
            Customer Email: '.$buyer['email'].'<br>
            Item Name: '.$item_name.'<br>
            Description: '.$item_description.'<br>
            Picture: Please check the attachment.<br><br>
            <b></b> <br>
            
            <div style="display: inline">
            <a style="border: 0;outline: 0;cursor: pointer;color: white;background-color: green;display:inline;border-radius: 4px;padding: 4px 8px;text-decoration:none" href="'.$url.'/action-offer.php?token='.$token.'&action=accept">Accept Offer</a><br><br>
            <a style="border: 0;outline: 0;cursor: pointer;color: white;background-color: red;border-radius: 4px;padding: 4px 8px;text-decoration:none" href="'.$url.'/action-offer.php?token='.$token.'&action=reject">Reject Offer</a></div>
            
            <br><br>
            <b>Thanks</b>.';
            
            $subject = 'Trade Offer Received';
            $attachment = 'img/'.$item_img;
            sendMail($subject, $seller['email'], $message, $attachment);
            $msg = '<div class="alert alert-success text-center">Thank you ' .$buyer['name'].', We got your details, Please wait for the response from the seller :)</div>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>2WEAR Shop - Product Detail Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/shop-single.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <section class="bg-light">
        <div class="container pb-5">
            <?php if(isset($msg)){ echo $msg; } ?>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <!-- Container for the image gallery -->
                            <?php
                                $sql = "SELECT * from item_pictures where item_id='$productid'";
                                $result = $conn->query($sql);
                                $total_images = $result->num_rows+1;
                                    
                            ?>
                            <!-- Full-width images with number text -->
                            <div class="mySlides">
                            <div class="numbertext zoom-box">1 / <?php echo $total_images; ?></div>
                                <img src="img/<?php echo $product['picture']; ?>" style="width:100%">
                            </div>
                            
                            <?php $i = 2; while($row = $result->fetch_assoc()){ ?>
                            <div class="mySlides">
                            <div class="numbertext zoom-box"><?php echo $i; ?> / <?php echo $total_images; ?></div>
                                <img src="img/<?php echo $row['picture']; ?>" style="width:100%">
                            </div>
                            <?php $i++; } ?>

                            <!-- Next and previous buttons -->
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        
                            <!-- Image text -->
                            <div class="caption-container">
                                <p id="caption"><b><?php echo $product['title']; ?></b></p>
                            </div>
                        
                    </div>
                </div>
                
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?php echo $product['title']; ?></h1>
                            <p class="h3 py-2"><?php echo $product['price']; ?> NIS</p>
                            
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Color :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $product['color']; ?></strong></p>
                                </li>
                            </ul>

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Size:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $product['size']; ?></strong></p>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Condition:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $product['condition_item']; ?></strong></p>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Gender:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $product['gender']; ?></strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p><?php echo $product['description']; ?>
                            </p>

                            <div id="map" style="height: 250px"></div>
                            
                            <br>
                            <!-- HTML code for the trade button and form -->
                            
                            <?php if(isset($_SESSION['user'])){ ?>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy" onclick="location.href='order-summary.php?id=<?php echo $productid; ?>'"
                                        id="buy">Buy</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="button" class="btn btn-success btn-lg" name="submit" value="trade" onclick="openUploadDialog()"
                                        id="trade">Trade</button>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <a href="login.php" class="btn btn-success btn-lg w-100">Please login to buy or trade this item</a>
                            <?php } ?>
                            
                            
                            <!-- HTML code for the item image and details upload form (hidden by default) -->
                            <form id="upload-form" style="display:none" method = "post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="item-name" class="form-label">Item Name</label>
                                    <input type="text" class="form-control" id="item-name" name="item_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="item-description" class="form-label">Item Description</label>
                                    <textarea class="form-control" id="item-description" rows="3" name="item_description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="item-img" class="form-label">Item Image</label>
                                    <input class="form-control" type="file" id="item-img" name="item_img" required>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button name="sumbit-trade" type="submit" class="btn btn-success">Upload</button>
                                    <button type="button" class="btn btn-danger" onclick="closeUploadDialog()">Cancel</button>
                                </div>
                            </form>
                        </div> 
                        
                    </div>
                    
            </div>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="h2">Looking For Something Similar ?</h1>
                    <div class="center">
                        <?php
                            $sql = "SELECT * from sales_items where id!='{$product['id']}' AND status='available' AND category='{$product['category']}' AND color='{$product['color']}' AND gender='{$product['gender']}' order by id desc";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                        ?>
                        <a href="shop-single.php?id=<?php echo $row['id']; ?>">
                            <img src="img/<?php echo $row['picture']; ?>" alt="Item Image" class="line similiar-image">
                        </a>
                        <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    


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
    <script>
        var address = '<?php echo $seller['city']; ?> <?php echo $seller['street']; ?>';
    </script>
    <script src="JS/index.js"></script>
    <script src="JS/shop-single.js"></script>
    
</body>
</html>