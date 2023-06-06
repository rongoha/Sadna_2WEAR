<?php
session_start();
include 'db_conn.php';
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $action = $_GET['action'];
    
    //Trade Item Details
    $sql = "SELECT * from trade_items where token='$token'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $trade_item = $result->fetch_assoc();
        $tradeid = $trade_item['id'];
        $buyerid = $trade_item['user_id'];
        
        //Product Details
        $productid = $trade_item['item_id'];
        $sql = "SELECT * from sales_items where id='$productid' AND status='available'";
        $result = $conn->query($sql);
        if($result->num_rows == 0){
            $_SESSION['message'] = "<div class='alert alert-danger'>Item has already been sold</div>";
            header("location:index.php");
            die();
        }
        $product = $result->fetch_assoc();
        
        //Seller Details
        $sellerid = $product['user_id'];
        $sql = "SELECT * from users where id='$sellerid'";
        $result = $conn->query($sql);
        $seller = $result->fetch_assoc();
        $seller_name = $seller['name'];
        $seller_email = $seller['email'];
        
        $purchase_type = 'trade';
        $transaction_id = "none";
        
        //Buyer Details
        $sql = "SELECT * from users where id='$buyerid'";
        $result = $conn->query($sql);
        $buyer = $result->fetch_assoc();
        $buyer_name = $buyer['name'];
        $buyer_email = $buyer['email'];
        
        if($action=='accept'){
            $sql = "update sales_items set status='sold' where id='$productid'";
            if($conn->query($sql)===TRUE){
                $sql = "INSERT INTO items_sold(item_id,purchase_type,transaction_id, full_name, email) 
                VALUES ('$productid','$purchase_type','$transaction_id','$buyer_name','$buyer_email')";
                $conn->query($sql);
                
                $sql = "DELETE from trade_items where id='$tradeid'";
                if($conn->query($sql)===TRUE){
                    $message = '<b>Dear Buyer,</b> 
                    <br>Your offer has been accepted by the seller of item: <b>'.$product['title'].'</b>. You can contact the seller.
                    <br><b>Seller Details:</b>
                    <br>Name: '.$seller_name.'
                    <br>Email: '.$seller_email.'
                    <br><br><b>Thanks</b>.';
                    
                    $subject = 'Offer Accepted';
                    sendMail($subject, $buyer_email, $message, $attachment="");
                    
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
                    
                    $_SESSION['message'] = "<div class='alert alert-success'>You've accepted the trade offer.</div>";
                    header("location:index.php");
                    die();
                }
            }
        }else{
            $sql = "DELETE from trade_items where id=$tradeid";
            if($conn->query($sql)===TRUE){
                $message = '<b>Dear Buyer,</b> 
                <br>Your offer has been rejected by the seller of item: <b>'.$product['title'].'</b>. 
                <br>Please try again.
                <br><br><b>Thanks</b>.';
                
                $subject = "Offer Rejected";
                sendMail($subject, $buyer_email, $message, $attachment="");
                $_SESSION['message'] = "<div class='alert alert-danger'>You've declined the trade offer.</div>";
                header("location:index.php");
                die();
            }
        }
    }
}