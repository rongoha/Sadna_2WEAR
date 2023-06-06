<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>2WEAR - About Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

</head>

<body>
    <?php include 'includes/navbar.php'; ?>



    <section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>About Us</h1>
                    <p>
                        Hello!<br>
                        <p>Welcome to 2WEAR, a platform created by four information systems students - Ron, Bar, Stav, and Gal - as part of a
                        project in the finall programming course at Tel Aviv-Yafo Academic College. Our goal was to create a site that promotes
                        recycling, repair, and reuse of clothing items, and that allows private individuals to sell and buy clothes anytime and
                        anywhere.</p>

                        <p>The fashion industry is responsible for a significant amount of waste and pollution, and we believe that 2WEAR can make
                        a difference. Our platform serves as an intermediary between the buyer and the seller, and it allows sellers to price
                        their items according to their wishes. By promoting the reuse and recycling of clothing items, 2WEAR aims to reduce the
                        environmental impact of the fashion industry and change the consumption habits of the community in Israel and around the
                        world.</p>

                        <p>2WEAR is not just an online marketplace, but also a platform that encourages environmental awareness and waste
                        reduction. Our site provides convenience to users by simplifying the buying and selling process and interfaces with
                        third-party systems to facilitate payment transactions, display of sale location, display of similar items, and
                        advertising new products. With 2WEAR, users can easily sell items they no longer need while allowing others to purchase
                        second-hand clothing of quality at affordable prices.</p>

                        <p>2WEAR meets the need for a sustainable and convenient way to buy and sell clothes, while promoting environmental
                        awareness and waste reduction. Join us in our mission to make a difference in the fashion industry and create a more
                        sustainable future for us all.</p>


                    </p>
                </div>
                
            </div>
        </div>
    </section>

    <section class="container py-5 ">
                       
        <div class="row">
            <div class="col-12 col-md-3 p-5 mt-3">
                <a href="#"><img src="img/ron-black.png" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Ron Gohar</h5>
            </div>
            <div class="col-12 col-md-3 p-5 mt-3">
                <a href="#"><img src="img/bar-black.png" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Bar Reuven</h5>
            </div>
            <div class="col-12 col-md-3 p-5 mt-3">
                <a href="#"><img src="img/stav-balck.png" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Stav Cohen</h2>
            </div>
            <div class="col-12 col-md-3 p-5 mt-3">
                <a href="#"><img src="img/galb.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Gal Baron</h2>
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
    <script src="JS/index.js"></script>
</body>


</html>