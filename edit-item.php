<?php
session_start();
include 'db_conn.php';
if(!isset($_SESSION['user'])){
    header("location:login.php");
    die();
}
$userid = $_SESSION['user'];
if(isset($_GET['id'])){
    $itemid = $_GET['id'];
    $sql = "SELECT * from sales_items where id='$itemid' AND user_id='$userid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $item = $result->fetch_assoc();
    }else{
        header("location:my-items.php");
        die();
    }
}



$userid = $_SESSION['user'];
if(isset($_POST['submit'])){
    $price =  $_POST['price'];
    $title =  $_POST['title'];
    $color =  $_POST['color'];
    $size =  $_POST['size'];
    $condition_item =  $_POST['condition_item'];
    $category =  $_POST['category'];
    if($category=='Shoes'){
        $size = $_POST['shoe_size'];
    }
    $description =  $_POST['description'];
    
    if(empty($price) || empty($title) || empty($color) || empty($size)){
        echo "Please enter all the requested fields!";
    }else{
        $sql="update sales_items set price='$price', title='$title', color='$color', size='$size', condition_item='$condition_item', category='$category', description='$description' where id='$itemid'";
        if($conn->query($sql)===TRUE){
            if(!empty($_FILES["picture"]["name"])){
                $picture = "";
                $path_parts = pathinfo($_FILES["picture"]["name"]);
                $extension = $path_parts['extension'];
                $extension = strtolower($extension);
                if($extension=='png' || $extension=='jpg' || $extension=='jpeg' || $extension=='gif'){
                    $picture = uniqid(time()).".$extension";
                    $picture_tmp = $_FILES['picture']['tmp_name'];
                    move_uploaded_file($picture_tmp, "img/$picture");
                    $sql = "update sales_items set picture='$picture' where id='$itemid'";
                    $conn->query($sql);
                }
            }
            $msg = '<div class="alert alert-success text-center">Items details updated.</div>';
            $sql = "SELECT * from sales_items where id='$itemid' AND user_id='$userid'";
            $result = $conn->query($sql);
            $item = $result->fetch_assoc();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> 2WEAR Shop - Edit Item </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        .form-check-input {
            margin-right: 15px;
        }
    </style>
</head>

<body>


    <?php include 'includes/navbar.php'; ?>
    <div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1>Edit Item</h1>
        </div>
    </div>

    <div class="container py-5">
        <?php if(isset($msg)){ echo $msg; } ?>
        <div class="row py-5">
            <form method="post" action="" class="col-md-9 m-auto" role="form1" name="form1" enctype="multipart/form-data">

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Title*</label>
                        <input type="text" class="form-control mt-1" id="title" name="title" placeholder="Title" minlength="3" maxlength="25" required value="<?php echo $item['title']; ?>">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputPrice">Price*</label>
                        <input type="number" min="1" max="10000000000" class="form-control mt-1" id="price" name="price" placeholder="Price" required value="<?php echo $item['price']; ?>">
                    </div>
                    
                    <br>
                    <div class="mb-3">
                        <div>
                            <p><b> Categories*</b> </p>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="tshirt" name="category" value="T-shirt">T-shirt
                                <label class="form-check-label" for="tshirt"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="pants" name="category" value="Pants">Pants
                                <label class="form-check-label" for="pants"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="coats" name="category" value="Coats & Jackets">Coats & Jackets
                                <label class="form-check-label" for="coats"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="tops" name="category" value="Tops">Tops
                                <label class="form-check-label" for="tops"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="blazers" name="category" value="Blazers">Blazers
                                <label class="form-check-label" for="blazers"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="jeans" name="category" value="Jeans">Jeans
                                <label class="form-check-label" for="jeans"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="skirts" name="category" value="Skirts">Skirts
                                <label class="form-check-label" for="skirts"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="shoes" name="category" value="Shoes">Shoes
                                <label class="form-check-label" for="shoes"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 ">
                        <br>
                        <label for="inputColors">Gender*</label>
                        <select name="gender" required id="gender">
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>
                    <div class="mb-3 ">
                        
                        <label for="inputColors">Colors*</label>
                        <select name="color" required id="color">
                            <option value="Black">Black</option>
                            <option value="White">White</option>
                            <option value="Red">Red</option>
                            <option value="Green">Green</option>
                            <option value="Pink">Pink</option>
                            <option value="Blue">Blue</option>
                            <option value="Yellow">Yellow</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputSize">Size*</label>
                        <select name="size" required id="other_size">
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <input placeholder="Enter Shoe Size" type="number" class="form-control" name="shoe_size" id="shoe_size" style="display:none">
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputCondition">Condition*</label>
                        <select name="condition_item" required id="condition">
                            <option value="Brand New">Brand New</option>
                            <option value="Used - Like New">Used - Like New</option>
                            <option value="Used - Fair">Used - Fair</option>
                            <option value="Used - Requires Fix">Used - Requires Fix</option>
                        </select>
                    </div>

                </div>
                <div>
                    <p>
                        <label><b> Update picture (optional)</b>
                            <input type="file" name="picture" id="file"></label>
                    </p>
                </div>
                <div class="mb-3">
                    <label for="inputmessage"><b>Description</b></label>
                    <textarea class="form-control mt-1" id="Description" name="description" placeholder="Description" rows="8"><?php echo $item['description']; ?></textarea>
                </div>
                <div class="col d-grid">
                    <input class="btn btn-success btn-lg" value="Submit" name="submit" type="submit">
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
                            © Ron Gohar & Bar Reuven & Stav Cohen & Gal Baron | 2023
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="JS/sell-my-clothes.js"></script>
    <script>
        
        $("input[name=category][value='<?php echo $item['category']; ?>']").attr('checked', 'checked');
        $("#color").val('<?php echo $item['color']; ?>');
        $("#gender").val('<?php echo $item['gender']; ?>');
        
        <?php if($item['category']=='Shoes'){ ?>
        $("#shoe_size").val('<?php echo $item['size']; ?>');
        $("#other_size").hide().prop('required', false);
        $("#shoe_size").show().prop('required', true);
        
        <?php }else{ ?>
        $("#other_size").val('<?php echo $item['size']; ?>');
        <?php } ?>
        
        
        $("#condition").val('<?php echo $item['condition_item']; ?>');
        
        $("input[name='category']").click(function() {
            if ($("input[name='category']:checked").val() == 'Shoes') {
                $("#other_size").hide().prop('required', false);
                $("#shoe_size").show().prop('required', true);
            } else {
                $("#other_size").show().prop('required', true);
                $("#shoe_size").hide().prop('required', false);
            }
        });
    </script>
</body>

</html>