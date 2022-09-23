<?php
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/OAuthTokenProvider.php';
require '../PHPMailer/src/OAuth.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/POP3.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendmail($email,$name,$title,$content){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(false);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'letrunghien2000@gmail.com';                     //SMTP username
        $mail->Password   = 'yjegqicnurhawsno';        //SMTP password, cái mật khảu này là xem đc cách sửa trên yt
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = "tls";
        $mail -> CharSet = "UTF-8";

        //Recipients
        $mail->setFrom('21jy0140@jec.ac.jp', 'Hien');
        //trùng với email cần lấy lại mk
        $mail->addAddress($email, $name);     //Add a recipient

        //$mail->addCC('cc@example.com'); //gửi cùng cho ng nhận biết chứ ko q trọng
        //$mail->addBCC('bcc@example.com'); //gửi nặc danh, vd gửi 1 tài liệu cho group, người đc gửi cùng sẽ ko hiện tên mail của nhau

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
