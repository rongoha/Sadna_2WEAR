<?php
ob_start();
session_start();
require_once 'db_conn.php';
if(isset($_SESSION['user']))
{
    header("location: index.php");
    die(); exit();
}

if(isset($_POST['submit'])){
    
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    $sql = "SELECT * from users where email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $msg = "<div class='alert alert-danger'>Sorry, an account with this email address already exists.</div>";
    }else{
        $options = [ 'cost' => 11];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
        $sql = "INSERT INTO users (name, email, street, city, phone, password) VALUES ('$full_name', '$email', '$street', '$city', '$phone', '$password')";
        
        if($conn->query($sql)===TRUE){
            $_SESSION['message'] = "<div class='alert alert-success'>Account created successfully.</div>";
            header("location:login.php");
            die();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
    <title> 2WEAR Shop - Register</title>
	 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
   
  
    <?php include 'includes/navbar.php'; ?>    
    <div class="container-fluid bg-light py-4">
        <div class="col-md-12 m-auto text-center">
            <h2>Register </h2>
        </div>
    </div>

    <div class="container py-3">
        <div class="row py-4 ">
            <form method = "post" action = "" col-md-9 m-auto role="form1" name="form1">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php if(isset($msg)){ echo $msg; } ?>
                        <div class="form-group mb-3">
                            <label for="inputname">Full Name*</label>
                            <input type="text" class="form-control mt-1" id="name" pattern="[讗-转A-Za-z ]+" name="name" placeholder="Name" minlength="2" maxlength="50" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputname">Phone*</label>
                            <input type="text" class="form-control mt-1" id="phone" name="phone" placeholder="Phone" minlength="4" maxlength="15" required>
                        </div>
                        <div class="form-group mb-3 form-field" id="city-selection">
                            <label for="inputlocation">City*</label>
                            <input type="text" class="form-control mt-1" list="cities-data"  id="location" name="city" minlength="2" maxlength="25" placeholder="City" required>
                            <datalist id="cities-data">
                                <option value="">Loading Cities....</option>
                            </datalist>
                        </div>
                        <div class="form-group mb-3 form-field" id="street-selection">
                            <label for="street-choice">Street*</label>
                            <input type="text" class="form-control mt-1" list="streets-data" id="street-choice" name="street" minlength="2" maxlength="25" placeholder="Street" required>
                            <datalist id="streets-data">
                                <option value="">bla</option>
                            </datalist>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputemail">Email*</label>
                            <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputemail">Password*</label>
                            <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col d-grid">
                            <input class="btn btn-success"  value="Register"  name="submit" type="submit" >
                        </div>
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
                            漏 Ron Gohar & Bar Reuven & Stav Cohen & Gal Baron | 2023
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="JS/sell-my-clothes.js"></script>
</body>

</html>