<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$host = "localhost";
$user = "id20832087_2wear";
$pass = "Stav12345678*";
$db = "id20832087_2wear";

//create connection
$conn=new mysqli($host,$user,$pass,$db);
$conn->set_charset("utf8");

//check the connection
if ($conn->connect_error){
   die("Connection failed: ".$conn->connect_error);
}

$url = "https://app2wear.000webhostapp.com";

$mailer = array(
    'host'=>'smtp.gmail.com',
    'username'=>'2wearclothings@gmail.com',
    'password'=>'qfxdohjfxhgbvfqv',
    'fromName'=>'2WEAR',
    'from'=>'2wearclothings@gmail.com'
);

function sendMail($subject, $email, $message, $attachment){
    global $mailer;
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;                                     
        $mail->isSMTP();                                          
        $mail->Host       = $mailer['host']; 
        $mail->SMTPAuth   = true;                         
        $mail->Username   = $mailer['username'];           
        $mail->Password   = $mailer['password'];                              
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;                               
        $mail->setFrom($mailer['from'], $mailer['fromName']);                                  
        $mail->addAddress($email, '');
        $mail->Subject = $subject;
        if(!empty($attachment)){
            $mail->addAttachment($attachment);
        }
        $mail->isHTML(true);
        $mail->Body= $message;
        if($mail->send()){
            
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        die();
    }
}


?>