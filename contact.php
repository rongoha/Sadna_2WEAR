<?php
session_start();
include 'db_conn.php';
if(isset($_POST['submit'])){
    $msg = "<div class='alert alert-success'>We got your message, Thanks!</div>";   
}

if(isset($_SESSION['user'])){
    $userid = $_SESSION['user'];
    $sql = "SELECT * from users where id='$userid'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}


?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
    <title> 2WEAR Shop - Contact Us</title>
	 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

</head>

<body>
    <?php include 'includes/navbar.php'; ?>
  
       
    <div class="container-fluid bg-light py-4">
        <div class="col-md-12 m-auto text-center">
            <?php if(isset($msg)){ echo $msg; } ?>
            <h2>Have a question? </h2>
            <h1>Contact Us!</h1>
            <a href="#"><img src="img/mail_1.png" class="py-3"></a>
            <ul class="list-unstyled text-dark text-muted footer-link-list">
                <li>
                    <p><span><strong>Phone Number: </strong><a class="text-decoration-none link-secondary" href="tel:012-345-6789">012-345-6789</a></p>
                </li>
                <li>
                    <p><span><strong>Email:</strong> <a class="text-decoration-none link-secondary" href="mailto:2wearclothings@gmail.com">2wearclothings@gmail.com</a></p>
                </li>
                <li>
                    <p><span><strong>Location:</strong></span> Dizengoff 123 Tel-Aviv</p>
                </li>
            </ul>
        </div>
    </div>

    <div class="container py-3">
        <div class="row py-4 ">
            <form method = "post" action = "" col-md-9 m-auto role="form1" name="form1">
                <div class="row ">
                    <!--publish form-->
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Full Name</label>
                        <input type="text" class="form-control mt-1" id="name" pattern="[讗-转A-Za-z ]+" name="full_name" placeholder="Name" minlength="4" maxlength="15" required  value="<?php if(isset($userid)){ echo $user['name']; } ?>">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail">Email</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email" required  value="<?php if(isset($userid)){ echo $user['email']; } ?>">
                    </div>
                </div>

				
                <div class="mb-3">
                    <label for="inputmessage"><b>Description</b></label>
                    <textarea class="form-control mt-1" id="Description" name="description" placeholder="Description" rows="8"></textarea>
                </div>
                <div class="col d-grid">
                    <input class="btn btn-success btn-lg"  value="Send Message"  name="submit" type="submit" >
                </div>
			    </div>
            </form>
            <!--end publish form-->
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
                            漏 Ron Gohar & Bar Reuven & Stav Cohen & Gal Baron | 2023
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	
    <script src="JS/index.js"></script>
    <script src="JS/sell-my-clothes.js"></script>
</body>

</html>