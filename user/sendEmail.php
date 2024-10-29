<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {

    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';          //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                      //Enable SMTP authentication
    $mail->Username   = 'lazadowebsite@gmail.com';  //SMTP write your email
    $mail->Password   = 'etmokrpczesxuchf';        //SMTP password
    $mail->SMTPSecure = 'ssl';                     //Enable implicit SSL encryption
    $mail->Port       = 465;

    // ตั้งค่า Character Encoding ให้รองรับภาษาไทย
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom($_POST["email"], $_POST["name"]); // Sender Email and name
    $mail->addAddress('lazadowebsite@gmail.com');     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email

    //Content
    $mail->isHTML(true);                   //Set email format to HTML
    $mail->Subject = $_POST["subject"];    // email subject headings
    $mail->Body    = $_POST["message"];    //email message

    try {
        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;  // แสดงข้อผิดพลาดกลับไปยัง AJAX
    }
}
