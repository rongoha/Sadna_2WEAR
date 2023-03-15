<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <?php
  
        $host = "localhost:3306";
        $user = "galbao_user";
        $pass = "1122334455";
        $db = "galbao_items";

       //create connection
       $conn=new mysqli($host,$user,$pass,$db);

       //check the connection
       if ($conn->connect_error){
           die("Connection failed: ".$conn->connect_error);
       }
       else{
           echo '<div class="container-fluid bg-light py-5"><div class="col-md-6 m-auto text-center">';
           echo "<h3>Connection successful! <h3><br>";
           echo '</div>';
           echo '</div>';
       }
       

        //get data
       if(isset($_POST['submit'])){
           $full_name =  $_POST['full_name'];
           $email =  $_POST['email'];
           $price =  $_POST['price'];
           $location =  $_POST['location'];
           $color =  $_POST['color'];
           $size =  $_POST['size'];
           $condition_item =  $_POST['condition_item'];
           $category =  $_POST['Radio'];
           $picture =  $_POST['picture'];
           $description =  $_POST['description'];
       }

       //validation if null inputs

       if(empty($full_name) || empty($email) || empty($price) || empty($location) || empty($color) || empty($size) || empty($condition_item) || empty($picture)){

           echo "Please enter all the requst fields!";
       }
       else
       {
           $sql="INSERT INTO Items(full_name,email,price,location,color,size,condition_item,category,picture,description) 
           VALUES ('$full_name','$email','$price','$location','$color','$size','$condition_item','$category','$picture','$description')";
           
       }
           

        if($conn->query($sql)===TRUE){
        echo '<div class="container-fluid bg-light py-5"><div class="col-md-6 m-auto text-center">';
        echo '<h1> Thank you ' .$_POST['full_name'].', We got your details, We just need your confirm on the next page to publish!<br></h1>';
        echo '<button class="btn btn-success btn-lg" onclick="location.href=\'../../confirm-publish.html\'">Next Page</button>';
        echo '</div>';
        echo '</div>';
        }

        else{
            echo "Can not add new user.  Error is: <br>".$conn->error;
        
        }

   ?>

            
   

    
</body>

</html>