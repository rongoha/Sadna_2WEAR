<?php
session_start();
include 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>2WEAR Shop - Product Listing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

</head>

<body>
    <?php include 'includes/navbar.php'; ?>


    <div class="container">
        <div class="row">


            <div class="col-lg-12">
                <?php if(isset($_GET['item_sold'])){ ?>
                <div class="alert alert-success text-center">
                    Item purchased successfully. We got your details and the seller has been notified.
                </div>
                <?php } ?>
                
                <?php if(isset($_GET['offer-accepted'])){ ?>
                <div class="alert alert-success text-center">
                    Offer accepted successfully. The buyer has been notified and will contact you.
                </div>
                <?php } ?>
                
                <?php if(isset($_GET['offer-rejected'])){ ?>
                <div class="alert alert-success text-center">
                    Offer rejected successfully. The buyer has been notified.
                </div>
                <?php } ?>
                
                <div class="row mt-4">
                    <?php
                        $sql = "SELECT * from sales_items where status='available' order by id desc";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 shop-image" src="img/<?php echo $row['picture']; ?>">

                            </div>
                            <div class="card-body">
                                <a href="shop-single.php?id=<?php echo $row['id']; ?>" class="h3 text-decoration-none"><?php echo $row['title']; ?></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>Size: <?php echo $row['size']; ?></li>

                                </ul>

                                <p class="text-center mb-0"><?php echo $row['price']; ?> NIS</p>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- End Content -->
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
    <script src="JS/shop.js"></script>
    <script src="JS/index.js"></script>

</body>

</html>