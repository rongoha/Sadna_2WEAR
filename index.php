<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>2WEAR - Online Second Hand Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/IndexStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    
</head>

<body>
    
        <?php include 'includes/navbar.php'; ?>
        <div class="carousel-inner">
            <div class="container">
                <div class="row p-5 frames">
                    <?php 
                        if(isset($_SESSION['message'])){
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./img/banner_img_01.jpg" alt="image">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="logo text-success">2WEAR</h1>
                            <h3 class="h2">Tiny and Perfect Online Second Hand Store</h3>
                            <p>
                                We believe no item should be thrown away - especially when it could be worn again. By giving clothes a second life, we’re powering the circular economy for fashion.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 >4 Steps to Opening A Store</h1>
                    <img class="steps" width="54" height="56" src="./img/1step.svg" alt="1.Choosing a seller type">
                    <h3>1 - Choosing a seller type</h3>
                    <img class="steps" width="52" height="54" src="./img/2step.svg" alt="2.Choosing a name for the store">
                    <h3>2 - Choosing a name for the store</h3>
                    <img class="steps" width="58" height="54" src="./img/step3.svg" alt="3.Uploading products">
                    <h3>3 - Uploading products</h3>
                    <img class="steps" width="65" height="66" src="./img/step4.svg" alt="4.Starting to sell">
                    <h3>4 - Starting to sell</h3>
                    <p class="text-center steps"><a class="btn btn-success" href="sell-my-clothes.php">Let's Start</a></p>
            </div>
        </div>
    </section>

   



    <footer class="bg-dark" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class=" text-success border-bottom pb-3 border-light logo">2WEAR Shop</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            Dizengoff 123 Tel-Aviv
                        </li>
                        <li>
                            <a class="text-decoration-none" href="tel:012-345-6789">012-345-6789</a>
                        </li>
                        <li>
                            <a class="text-decoration-none" href="mailto:info@company.com">2wearclothings@gmail.com</a>
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
    <script src="./JS/index.js"></script>
</body>
</html>